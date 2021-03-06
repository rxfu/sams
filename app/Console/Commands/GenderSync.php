<?php

namespace App\Console\Commands;

use App\Services\GenderService;
use Illuminate\Console\Command;

class GenderSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:gender';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync genders from network information center';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Sync';

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
    public function handle(GenderService $service)
    {
        $service->sync();

        $this->info($this->type . ' genders successfully.');
    }
}
