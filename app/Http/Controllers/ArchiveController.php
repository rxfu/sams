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

class ArchiveController extends Controller
{
    protected $studentService;

    protected $departmentService;

    protected $majorService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\ArchiveService  $archiveService
     * @param \App\Services\StudenttService  $studentService
     * @param \App\Services\DepartmentService  $departmentService
     * @param \App\Services\MajortService  $majorService
     * @return void
     */
    public function __construct(ArchiveService $archiveService, StudentService $studentService, DepartmentService $departmentService, MajorService $majorService)
    {
        $this->authorizeResource(Archive::class, 'archive');

        $this->service = $archiveService;
        $this->studentService = $studentService;
        $this->departmentService = $departmentService;
        $this->majorService = $majorService;
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
     * Export the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function export(Request $request)
    {
        $this->authorize('export', Archive::class);

        $this->success(200010);

        return $this->service->exportExcel(new ArchiveExport, 'export.xlsx');
    }

    /**
     * Show the specified resource search form in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showSearchForm(Request $request)
    {
        $this->authorize('search', Archive::class);

        $departments = $this->departmentService->getEnableItems();
        $majors = $this->majorService->getEnableItems();
        $grades = $this->studentService->getAllGrades();
        $levels = ['教务管理系统', '研究生系统'];

        return view('archive.search', compact('departments', 'majors', 'grades', 'levels'));
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

        return redirect()->route('archives.search', $items);
    }
}
