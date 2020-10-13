<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Services\MajorService;
use App\Services\StudentService;
use App\Services\DepartmentService;
use App\Services\CenterStudentService;
use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;

class StudentController extends Controller
{
    protected $centerStudentService;

    protected $departmentService;

    protected $majorService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\StudentService  $studentService
     * @param \App\Services\CenterStudentService  $centerStudentService
     * @param \App\Services\DepartmentService  $departmentService
     * @param \App\Services\MajortService  $majorService
     * @return void
     */
    public function __construct(StudentService $studentService, CenterStudentService $centerStudentService, DepartmentService $departmentService, MajorService $majorService)
    {
        $this->authorizeResource(Student::class, 'student');

        $this->service = $studentService;
        $this->centerStudentService = $centerStudentService;
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
        // $items = $this->centerStudentService->getAll();
        $items = [];

        return view('student.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StudentStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentStoreRequest $request)
    {
        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('students.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $item = $this->service->get($student);

        return response()->json([
            'message' => 'success',
            'idnumber' => $item->idnumber,
            'name' => $item->name,
            'department' => $item->department->name,
            'major' => $item->major->name,
            'grade' => $item->grade,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        $item = $this->service->get($student);

        return view('student.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StudentUpdateRequest  $request
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentUpdateRequest $request, Student $student)
    {
        if ($request->isMethod('put')) {

            $this->service->update($student, $request->all());

            return redirect()->route('students.show', $student);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Student $student)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($student);

            return redirect()->route('students.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Sync a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function sync()
    {
        $this->authorize('sync', Student::class);

        if ($this->service->sync()) {
            $this->success(200011);
        }

        return back();
    }

    /**
     * Search the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->authorize('search', Student::class);

        $departments = $this->departmentService->getCollege();
        $majors = $this->majorService->getEnableItems();
        $grades = $this->centerStudentService->getAllGrades();
        $levels = $this->centerStudentService->getAllLevels();
        $levels->each(function ($item) {
            if ('教务管理系统' == $item->level) {
                $item->level = 0;
            } elseif ('研究生系统' == $item->level) {
                $item->level = 1;
            }
        });

        $attributes = [];
        $items = null;
        if ($request->hasAny(['id', 'name', 'level', 'department', 'major', 'grade'])) {
            $attributes = [
                'id' => $request->input('id'),
                'name' => $request->input('name'),
                'level' => $request->input('level'),
                'department' => $request->input('department'),
                'major' => $request->input('major'),
                'grade' => $request->input('grade'),
            ];

            $items = $this->centerStudentService->search($attributes, 10);
        }

        return view('student.search', compact('departments', 'majors', 'grades', 'levels', 'attributes', 'items'));
    }
}
