<?php

namespace App\Console\Commands;

use App\Services\DepartmentService;
use Illuminate\Console\Command;

class DepartmentSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:department';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync departments from network information center';

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
    public function handle(DepartmentService $service)
    {
        $service->sync();

        $this->info($this->type . 'nations successfully.');
    }
}
