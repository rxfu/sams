<?php

namespace App\Exports;

use App\Models\Entry;
use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromView;

class ArchiveExport implements FromView
{
    /**
     * @return View
     */
    public function view(): View
    {
        $entries = Entry::orderBy('order')
            ->get();

        $students = Student::orderBy('xh')
            ->get();

        return view('exports.archive', compact('entries', 'students'));
    }
}
