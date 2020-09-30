<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenderStoreRequest;
use App\Http\Requests\GenderUpdateRequest;
use App\Models\Gender;
use App\Services\CenterGenderService;
use App\Services\GenderService;
use Illuminate\Http\Request;

class GenderController extends Controller
{
    protected $centerGenderService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\GenderService  $genderService
     * @param \App\Services\CenterGenderService  $centerGenderService
     * @return void
     */
    public function __construct(GenderService $genderService, CenterGenderService $centerGenderService)
    {
        $this->authorizeResource(Gender::class, 'gender');

        $this->service = $genderService;
        $this->centerGenderService = $centerGenderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->centerGenderService->getAll();

        return view('gender.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('gender.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\GenderStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GenderStoreRequest $request)
    {
        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('genders.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function show(Gender $gender)
    {
        $item = $this->service->get($gender);

        return view('gender.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function edit(Gender $gender)
    {
        $item = $this->service->get($gender);

        return view('gender.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\GenderUpdateRequest  $request
     * @param  Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function update(GenderUpdateRequest $request, Gender $gender)
    {
        if ($request->isMethod('put')) {

            $this->service->update($gender, $request->all());

            return redirect()->route('genders.show', $gender);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Gender  $gender
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Gender $gender)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($gender);

            return redirect()->route('genders.index');
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
        $this->authorize('sync', Gender::class);

        if ($this->service->sync()) {
            $this->success(200011);
        }

        return back();
    }
}
