<?php

namespace App\Http\Controllers;

use App\Http\Requests\MajorStoreRequest;
use App\Http\Requests\MajorUpdateRequest;
use App\Models\Major;
use App\Services\MajorService;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\MajorService  $majorService
     * @return void
     */
    public function __construct(MajorService $majorService)
    {
        $this->authorizeResource(Major::class, 'major');

        $this->service = $majorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('major.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('major.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\MajorStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MajorStoreRequest $request)
    {
        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('majors.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Major  $major
     * @return \Illuminate\Http\Response
     */
    public function show(Major $major)
    {
        $item = $this->service->get($major);

        return view('major.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Major  $major
     * @return \Illuminate\Http\Response
     */
    public function edit(Major $major)
    {
        $item = $this->service->get($major);

        return view('major.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\MajorUpdateRequest  $request
     * @param  Major  $major
     * @return \Illuminate\Http\Response
     */
    public function update(MajorUpdateRequest $request, Major $major)
    {
        if ($request->isMethod('put')) {

            $this->service->update($major, $request->all());

            return redirect()->route('majors.show', $major);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Major  $major
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Major $major)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($major);

            return redirect()->route('majors.index');
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
        $this->authorize('sync', Major::class);

        if ($this->service->sync()) {
            $this->success(200011);
        }

        return back();
    }
}
