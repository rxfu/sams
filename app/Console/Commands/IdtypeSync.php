<?php

namespace App\Console\Commands;

use App\Services\IdtypeService;
use Illuminate\Console\Command;

class IdtypeSync extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:idtype';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync idtypes from network information center';

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
    public function handle(IdtypeService $service)
    {
        $service->sync();

        $this->info($this->type . 'idtypes successfully.');
    }
}
