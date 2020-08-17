<?php

namespace App\Imports;

use App\Models\Entry;
use App\Models\Archive;
use Maatwebsite\Excel\Row;
use App\Services\ArchiveService;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ArchiveImport implements OnEachRow, WithStartRow
{
    protected $archiveService;

    public function __construct(ArchiveService $archiveService)
    {
        $this->archiveService = $archiveService;
    }
    /**
     * @param \Maatwebsite\Excel\Row $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        $data['sid'] = $row[0];

        $i = 2;
        $entries = Entry::orderBy('order')->get();
        foreach ($entries as $entry) {
            $data['entry'][$entry->id] = $row[$i++];
        }

        $archive = $this->archiveService->getBySid($data['sid']);
        if (empty($archive)) {
            $this->archiveService->store($data);
        } else {
            $this->archiveService->update($archive, $data);
        }
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 4;
    }
}
