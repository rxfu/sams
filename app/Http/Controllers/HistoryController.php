<?php

namespace App\Http\Controllers;

use App\Models\History;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Services\MajorService;
use App\Services\HistoryService;
use App\Services\StudentService;
use App\Services\DepartmentService;
use App\Http\Requests\HistoryStoreRequest;
use App\Http\Requests\HistoryUpdateRequest;

class HistoryController extends Controller
{
    protected $studentService;

    protected $departmentService;

    protected $majorService;

    protected $groupService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\HistoryService  $historyService
     * @param \App\Services\StudenttService  $studentService
     * @param \App\Services\DepartmentService  $departmentService
     * @param \App\Services\MajortService  $majorService
     * @param \App\Services\GroupService  $groupService
     * @return void
     */
    public function __construct(HistoryService $historyService, StudentService $studentService, DepartmentService $departmentService, MajorService $majorService, GroupService $groupService)
    {
        $this->authorizeResource(History::class, 'history');

        $this->service = $historyService;
        $this->studentService = $studentService;
        $this->departmentService = $departmentService;
        $this->majorService = $majorService;
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $departments = $this->service->getDepartments();
        $majors = $this->service->getMajors();
        $grades = $this->service->getGrades();
        $levels = $this->service->getLevels();

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

        return view('history.index', compact('departments', 'majors', 'grades', 'levels', 'attributes', 'items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = $this->departmentService->getCollege();
        $majors = $this->majorService->getEnableItems();
        $grades = $this->studentService->getAllGrades();
        $levels = $this->groupService->getAll();

        return view('shared.export', compact('departments', 'majors', 'grades', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\HistoryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(HistoryStoreRequest $request)
    {
        if ($request->isMethod('post')) {

            $attributes = [];
            if ($request->hasAny(['level', 'department', 'major', 'grade'])) {
                $attributes = [
                    'level' => $request->input('level'),
                    'department' => $request->input('department'),
                    'major' => $request->input('major'),
                    'grade' => $request->input('grade'),
                ];
            }

            $item = $this->service->store($attributes);

            return redirect()->route('histories.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  History  $history
     * @return \Illuminate\Http\Response
     */
    public function show(History $history)
    {
        $item = $this->service->get($history);

        return view('history.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  History  $history
     * @return \Illuminate\Http\Response
     */
    public function edit(History $history)
    {
        $item = $this->service->get($history);

        return view('history.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\HistoryUpdateRequest  $request
     * @param  History  $history
     * @return \Illuminate\Http\Response
     */
    public function update(HistoryUpdateRequest $request, History $history)
    {
        if ($request->isMethod('put')) {

            $this->service->update($history, $request->all());

            return redirect()->route('histories.show', $history);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  History  $history
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, History $history)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($history);

            return redirect()->route('histories.index');
        }

        $this->error(405001);

        return back();
    }
}
