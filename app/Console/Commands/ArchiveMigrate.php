<?php

namespace App\Console\Commands;

use App\Models\Entry;
use App\Models\LegacyDelivery;
use App\Models\LegacyStudent;
use App\Models\Student;
use App\Services\ArchiveService;
use App\Services\DeliveryService;
use Illuminate\Console\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

class ArchiveMigrate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrate:archives';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Migrate archives from olde database to new database';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Migrate';

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
    public function handle(ArchiveService $archiveService, DeliveryService $deliveryService)
    {
        $students = Student::all();
        $entries = Entry::whereIsEnable(true)->get();

        $output = new ConsoleOutput();
        $progressBar = new ProgressBar($output, $students->count());
        $progressBar->setFormat("预计需要时间   %elapsed:6s%/%estimated:-6s%   内存消耗: %memory:6s%\n%current%/%max% [%bar%] %percent:3s%%");

        foreach ($students as $student) {
            if (!$archiveService->getBySid($student->id)) {
                $legacyStudent = LegacyStudent::where('学号', '=', $student->id);

                if ($legacyStudent->exists()) {
                    $legacyStudent = $legacyStudent->first();

                    foreach ($entries as $entry) {
                        $data['entry'][$entry->id] = $legacyStudent->{$entry->name};
                    }

                    $data['sid'] = $student->id;
                    $data['received_at'] = $legacyStudent->{'材料录入时间'};

                    $archive = $archiveService->store($data);

                    $legacyDelivery = LegacyDelivery::where('学号', '=', $student->id);

                    if ($legacyDelivery->exists()) {
                        $legacyDelivery = $legacyDelivery->first();

                        $deliveryData = [
                            'archive_id' => $archive->id,
                            'receiver' => $legacyDelivery->{'档案接收单位'},
                            'ems' => $legacyDelivery->{'机要号'},
                            'zipcode' => $legacyDelivery->{'邮政编码'},
                            'reason' => $legacyDelivery->{'转递原因'},
                            'employment' => $legacyDelivery->{'就业单位名称'},
                            'send_at' => $legacyDelivery->{'寄送时间'},
                            'status' => '1',
                            'remark' => $legacyDelivery->{'备注'} . $legacyDelivery->{'备注2'} . $legacyDelivery->{'备注3'},
                        ];

                        $deliveryService->store($deliveryData);
                    }
                }
            }

            $progressBar->advance();
        }

        $progressBar->finish();
        echo "\n";
        $this->info($this->type . ' archives successfully.');
    }
}
