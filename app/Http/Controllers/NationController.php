<?php

namespace App\Http\Controllers;

use App\Http\Requests\NationStoreRequest;
use App\Http\Requests\NationUpdateRequest;
use App\Models\Nation;
use App\Services\CenterNationService;
use App\Services\NationService;
use Illuminate\Http\Request;

class NationController extends Controller
{
    protected $centerNationService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\NationService  $nationService
     * @param \App\Services\CenterNationService  $centerNationService
     * @return void
     */
    public function __construct(NationService $nationService, CenterNationService $centerNationService)
    {
        $this->authorizeResource(Nation::class, 'nation');

        $this->service = $nationService;
        $this->centerNationService = $centerNationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->centerNationService->getAll();

        return view('nation.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('nation.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\NationStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NationStoreRequest $request)
    {
        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('nations.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Nation  $nation
     * @return \Illuminate\Http\Response
     */
    public function show(Nation $nation)
    {
        $item = $this->service->get($nation);

        return view('nation.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Nation  $nation
     * @return \Illuminate\Http\Response
     */
    public function edit(Nation $nation)
    {
        $item = $this->service->get($nation);

        return view('nation.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\NationUpdateRequest  $request
     * @param  Nation  $nation
     * @return \Illuminate\Http\Response
     */
    public function update(NationUpdateRequest $request, Nation $nation)
    {
        if ($request->isMethod('put')) {

            $this->service->update($nation, $request->all());

            return redirect()->route('nations.show', $nation);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Nation  $nation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Nation $nation)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($nation);

            return redirect()->route('nations.index');
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
        $this->authorize('sync', Nation::class);

        if ($this->service->sync()) {
            $this->success(200011);
        }

        return back();
    }
}
