<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentStoreRequest;
use App\Http\Requests\StudentUpdateRequest;
use App\Models\Student;
use App\Services\StudentService;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\StudentService  $studentService
     * @return void
     */
    public function __construct(StudentService $studentService)
    {
        // $this->authorizeResource(Student::class, 'student');

        $this->service = $studentService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

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
            'card_number' => $item->sfzh,
            'name' => $item->xm,
            'department' => $item->xy,
            'major' => $item->zy,
            'grade' => $item->nj,
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
}
