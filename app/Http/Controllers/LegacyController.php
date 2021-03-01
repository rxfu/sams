<?php

namespace App\Http\Controllers;

use App\Models\Legacy;
use Illuminate\Http\Request;
use App\Services\GroupService;
use App\Services\MajorService;
use App\Services\LegacyService;
use App\Services\StudentService;
use App\Services\DepartmentService;
use App\Http\Requests\LegacyStoreRequest;
use App\Http\Requests\LegacyUpdateRequest;

class LegacyController extends Controller
{
    protected $studentService;

    protected $departmentService;

    protected $majorService;

    protected $groupService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\LegacyService  $legacyService
     * @param \App\Services\StudenttService  $studentService
     * @param \App\Services\DepartmentService  $departmentService
     * @param \App\Services\MajortService  $majorService
     * @param \App\Services\GroupService  $groupService
     * @return void
     */
    public function __construct(LegacyService $legacyService, StudentService $studentService, DepartmentService $departmentService, MajorService $majorService, GroupService $groupService)
    {
        $this->authorizeResource(Legacy::class, 'legacy');

        $this->service = $legacyService;
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

        return view('legacy.index', compact('departments', 'majors', 'grades', 'levels', 'attributes', 'items'));
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
     * @param  \App\Http\Requests\LegacyStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LegacyStoreRequest $request)
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

            return redirect()->route('legacies.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Legacy  $legacy
     * @return \Illuminate\Http\Response
     */
    public function show(Legacy $legacy)
    {
        $item = $this->service->get($legacy);

        return view('legacy.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Legacy  $legacy
     * @return \Illuminate\Http\Response
     */
    public function edit(Legacy $legacy)
    {
        $item = $this->service->get($legacy);

        return view('legacy.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\LegacyUpdateRequest  $request
     * @param  Legacy  $legacy
     * @return \Illuminate\Http\Response
     */
    public function update(LegacyUpdateRequest $request, Legacy $legacy)
    {
        if ($request->isMethod('put')) {

            $this->service->update($legacy, $request->all());

            return redirect()->route('legacies.show', $legacy);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Legacy  $legacy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Legacy $legacy)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($legacy);

            return redirect()->route('legacies.index');
        }

        $this->error(405001);

        return back();
    }
}
