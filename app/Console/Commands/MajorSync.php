<?php

namespace App\Console\Commands;

use App\Services\MajorService;
use Illuminate\Console\Command;

class MajorSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:major';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync majors from network information cente';

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
    public function handle(MajorService $service)
    {
        $service->sync();

        $this->info($this->type . 'majors successfully.');
    }
}
