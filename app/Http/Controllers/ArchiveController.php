<?php

namespace App\Http\Controllers;

use App\Models\Archive;
use Illuminate\Http\Request;
use App\Exports\ArchiveExport;
use App\Imports\ArchiveImport;
use App\Services\MajorService;
use App\Services\ArchiveService;
use App\Services\StudentService;
use App\Services\DepartmentService;
use App\Http\Requests\ArchiveStoreRequest;
use App\Http\Requests\ArchiveUpdateRequest;
use App\Services\EntryService;
use App\Services\GroupService;

class ArchiveController extends Controller
{
    protected $studentService;

    protected $departmentService;

    protected $majorService;

    protected $groupService;

    protected $entryService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\ArchiveService  $archiveService
     * @param \App\Services\StudenttService  $studentService
     * @param \App\Services\DepartmentService  $departmentService
     * @param \App\Services\MajortService  $majorService
     * @param \App\Services\GroupService  $groupService
     * @param \App\Services\EntryService  $entryService
     * @return void
     */
    public function __construct(ArchiveService $archiveService, StudentService $studentService, DepartmentService $departmentService, MajorService $majorService, GroupService $groupService, EntryService $entryService)
    {
        $this->authorizeResource(Archive::class, 'archive');

        $this->service = $archiveService;
        $this->studentService = $studentService;
        $this->departmentService = $departmentService;
        $this->majorService = $majorService;
        $this->groupService = $groupService;
        $this->entryService = $entryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('archive.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('archive.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ArchiveStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArchiveStoreRequest $request)
    {
        if ($request->isMethod('post')) {
            $item = $this->service->store($request->all());

            return redirect()->route('archives.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function show(Archive $archive)
    {
        $item = $this->service->get($archive);

        return view('archive.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function edit(Archive $archive)
    {
        $item = $this->service->get($archive);

        return view('archive.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ArchiveUpdateRequest  $request
     * @param  Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function update(ArchiveUpdateRequest $request, Archive $archive)
    {
        if ($request->isMethod('put')) {

            $this->service->update($archive, $request->all());

            return redirect()->route('archives.show', $archive);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Archive  $archive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Archive $archive)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($archive);

            return redirect()->route('archives.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Show the form for importing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showImportForm()
    {
        $this->authorize('import', Archive::class);

        return view('shared.import');
    }

    /**
     * Import the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $this->authorize('import', Archive::class);

        if ($request->isMethod('post')) {

            $this->service->import(new ArchiveImport($this->service), $request->file('import'));

            $this->success(200009);

            return redirect()->route('archives.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Show the form for exporting the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showExportForm()
    {
        $this->authorize('export', Archive::class);

        $departments = $this->departmentService->getCollege();
        $majors = $this->majorService->getEnableItems();
        $grades = $this->studentService->getAllGrades();
        $levels = $this->groupService->getAll();

        return view('shared.export', compact('departments', 'majors', 'grades', 'levels'));
    }

    /**
     * Export the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $this->authorize('export', Archive::class);

        $attributes = [];
        if ($request->hasAny(['level', 'department', 'major', 'grade'])) {
            $attributes = [
                'level' => $request->input('level'),
                'department' => $request->input('department'),
                'major' => $request->input('major'),
                'grade' => $request->input('grade'),
            ];
        }

        $this->success(200010);

        return $this->service->exportExcel(new ArchiveExport($this->studentService, $attributes), 'export.xlsx');
    }

    /**
     * Show the form for exporting the specified resource by pdf.
     *
     * @return \Illuminate\Http\Response
     */
    public function showExportTransferForm()
    {
        $this->authorize('transfer', Archive::class);

        $departments = $this->departmentService->getCollege();
        $majors = $this->majorService->getEnableItems();
        $grades = $this->studentService->getAllGrades();
        $levels = $this->groupService->getAll();

        return view('shared.export', compact('departments', 'majors', 'grades', 'levels'));
    }

    /**
     * Export the specified resource by pdf in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportTransfer(Request $request)
    {
        $this->authorize('transfer', Archive::class);

        $attributes = [];
        if ($request->hasAny(['level', 'department', 'major', 'grade'])) {
            $attributes = [
                'level' => $request->input('level'),
                'department' => $request->input('department'),
                'major' => $request->input('major'),
                'grade' => $request->input('grade'),
            ];
        }

        $entries = $this->entryService->getActiveItems();

        $students = $this->studentService->getAllStudents($attributes, ['archive', 'archive.entries'], 'id');

        $this->success(200010);

        $options = [
            'footer-center' => '- [page] -',
            'footer-font-size' => 5,
            'footer-spacing' => 5,
            'footer-left' => '注：此表一式两份，移交单位保管一份，档案馆保管一份。',
            'orientation' => 'landscape',
        ];

        return $this->service->exportPdf('exports.archive-transfer', compact('students', 'entries'), 'transfer.pdf', $options);
    }

    /**
     * Search the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->authorize('search', Archive::class);

        $departments = $this->departmentService->getCollege();
        $majors = $this->majorService->getEnableItems();
        $grades = $this->studentService->getAllGrades();
        $levels = $this->groupService->getAll();

        $attributes = [];
        $items = null;
        if ($request->hasAny(['id', 'name', 'level', 'department', 'major', 'grade'])) {
            $attributes = [
                'sid' => $request->input('id'),
                'name' => $request->input('name'),
                'level' => $request->input('level'),
                'department' => $request->input('department'),
                'major' => $request->input('major'),
                'grade' => $request->input('grade'),
            ];

            $items = $this->service->search($attributes, 10);
        }

        return view('archive.search', compact('departments', 'majors', 'grades', 'levels', 'attributes', 'items'));
    }

    /**
     * List the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request)
    {
        if ($request->ajax()) {
            $keyword = $request->input('q');

            $result = $this->service->list($keyword);

            return response()->json($result);
        }
    }
}
