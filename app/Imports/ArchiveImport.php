<?php

namespace App\Imports;

use App\Models\Entry;
use App\Models\Archive;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class ArchiveImport implements OnEachRow, WithStartRow
{
    /**
     * @param \Maatwebsite\Excel\Row $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        $creatorId = Auth::id();
        $archive = Archive::UpdateOrCreate([
            'sid' => $row[0],
        ], [
            'receive_at' => now(),
            'creator_id' => $creatorId,
            'editor_id' => $creatorId,
        ]);

        $entries = Entry::orderBy('order')->get();
        $i = 2;
        foreach ($entries as $entry) {
            $archive->attach($entry->id, [
                'quantity' => $row[$i++],
                'creator_id' => $creatorId,
                'editor_id' => $creatorId,
            ]);
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
