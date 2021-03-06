<?php

namespace App\Http\Controllers;

use App\Models\Delivery;
use Illuminate\Http\Request;
use App\Services\MajorService;
use App\Imports\DeliveryImport;
use App\Services\StudentService;
use App\Services\DeliveryService;
use App\Services\DepartmentService;
use App\Http\Requests\DeliveryStoreRequest;
use App\Http\Requests\DeliveryUpdateRequest;
use App\Services\GroupService;

class DeliveryController extends Controller
{
    protected $studentService;

    protected $departmentService;

    protected $majorService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\DeliveryService  $deliveryService
     * @param \App\Services\StudenttService  $studentService
     * @param \App\Services\DepartmentService  $departmentService
     * @param \App\Services\MajortService  $majorService
     * @param \App\Services\GrouptService  $groupService
     * @return void
     */
    public function __construct(DeliveryService $deliveryService, StudentService $studentService, DepartmentService $departmentService, MajorService $majorService, GroupService $groupService)
    {
        $this->authorizeResource(Delivery::class, 'delivery');

        $this->service = $deliveryService;
        $this->studentService = $studentService;
        $this->departmentService = $departmentService;
        $this->majorService = $majorService;
        $this->groupService = $groupService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('delivery.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('delivery.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\DeliveryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeliveryStoreRequest $request)
    {
        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('deliveries.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        $item = $this->service->get($delivery);

        return view('delivery.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function edit(Delivery $delivery)
    {
        $item = $this->service->get($delivery);

        return view('delivery.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\DeliveryUpdateRequest  $request
     * @param  Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(DeliveryUpdateRequest $request, Delivery $delivery)
    {
        if ($request->isMethod('put')) {

            $this->service->update($delivery, $request->all());

            return redirect()->route('deliveries.show', $delivery);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Delivery $delivery)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($delivery);

            return redirect()->route('deliveries.index');
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
        $this->authorize('import', Delivery::class);

        return view('shared.import');
    }

    /**
     * Import the specified users in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $this->authorize('import', Delivery::class);

        if ($request->isMethod('post')) {

            $this->service->import(new DeliveryImport($this->service), $request->file('import'));

            $this->success(200009);

            return redirect()->route('deliveries.search');
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
        $this->authorize('export', Delivery::class);

        $this->success(200010);

        return $this->service->exportExcel(new DeliveryExport, 'export.xlsx');
    }

    /**
     * Search the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $this->authorize('search', Delivery::class);

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

        return view('delivery.search', compact('departments', 'majors', 'grades', 'levels', 'attributes', 'items'));
    }

    /**
     * Show the form for exporting the notice specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showExportNoticeForm()
    {
        $this->authorize('notice', Delivery::class);

        $departments = $this->departmentService->getCollege();
        $majors = $this->majorService->getEnableItems();
        $grades = $this->studentService->getAllGrades();
        $levels = $this->groupService->getAll();

        return view('shared.send', compact('departments', 'majors', 'grades', 'levels'));
    }

    /**
     * Export the specified resource ems in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportNotice(Request $request)
    {
        $this->authorize('notice', Delivery::class);

        $attributes = [];
        if ($request->hasAny(['level', 'department', 'major', 'grade', 'send_at'])) {
            $attributes = [
                'level' => $request->input('level'),
                'department' => $request->input('department'),
                'major' => $request->input('major'),
                'grade' => $request->input('grade'),
                'send_at' => $request->input('send_at')
            ];
        }

        $deliveries = $this->service->getAllByStatus($attributes, false);
        $this->service->sent($deliveries);

        $this->success(200010);

        return $this->service->exportPdf('exports.delivery-notice', compact('deliveries'), 'notice.pdf');
    }

    /**
     * Show the form for exporting the ems specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showExportEmsForm()
    {
        $this->authorize('ems', Delivery::class);

        $departments = $this->departmentService->getCollege();
        $majors = $this->majorService->getEnableItems();
        $grades = $this->studentService->getAllGrades();
        $levels = $this->groupService->getAll();

        return view('shared.send', compact('departments', 'majors', 'grades', 'levels'));
    }

    /**
     * Export the specified resource ems in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportEms(Request $request)
    {
        $this->authorize('ems', Delivery::class);

        $attributes = [];
        if ($request->hasAny(['level', 'department', 'major', 'grade', 'send_at'])) {
            $attributes = [
                'level' => $request->input('level'),
                'department' => $request->input('department'),
                'major' => $request->input('major'),
                'grade' => $request->input('grade'),
                'send_at' => $request->input('send_at'),
            ];
        }

        $deliveries = $this->service->getAllByStatus($attributes, true);

        $this->success(200010);

        return $this->service->exportPdf('exports.delivery-ems', compact('deliveries'), 'ems.pdf');
    }
}
