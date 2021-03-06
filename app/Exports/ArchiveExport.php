<?php

namespace App\Exports;

use App\Models\Entry;
use App\Models\Student;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\DefaultValueBinder;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;

class ArchiveExport extends DefaultValueBinder implements FromView, WithCustomValueBinder
{
    protected $studentService;

    protected $attributes;

    public function __construct($studentService, $attributes)
    {
        $this->studentService = $studentService;
        $this->attributes = $attributes;
    }

    /**
     * @return View
     */
    public function view(): View
    {
        $entries = Entry::orderBy('order')
            ->get();

        $students = $this->studentService->getAllStudents($this->attributes, ['archive', 'archive.entries'], 'id');

        return view('exports.archive', compact('entries', 'students'));
    }

    /**
     * Bind value to a cell.
     *
     * @param Cell $cell Cell to bind value to
     * @param mixed $value Value to bind in cell
     *
     * @return bool
     */
    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);

            return true;
        }

        return parent::bindValue($cell, $value);
    }
}
