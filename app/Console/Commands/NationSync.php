<?php

namespace App\Console\Commands;

use App\Services\NationService;
use Illuminate\Console\Command;

class NationSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:nation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync nations from network information center';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(NationService $service)
    {
        $service->sync();

        $this->info($this->type . 'nations successfully.');
    }
}
