<?php

namespace App\Http\Controllers;

use App\Http\Requests\IdtypeStoreRequest;
use App\Http\Requests\IdtypeUpdateRequest;
use App\Models\Idtype;
use App\Services\CenterIdtypeService;
use App\Services\IdtypeService;
use Illuminate\Http\Request;

class IdtypeController extends Controller
{
    protected $centerIdtypeService;

    /**
     * Create a new controller instance.
     *
     * @param \App\Services\IdtypeService  $idtypeService
     * @param \App\Services\CenterIdtypeService  $centerIdtypeService
     * @return void
     */
    public function __construct(IdtypeService $idtypeService, CenterIdtypeService $centerIdtypeService)
    {
        $this->authorizeResource(Idtype::class, 'idtype');

        $this->service = $idtypeService;
        $this->centerIdtypeService = $centerIdtypeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->centerIdtypeService->getAll();

        return view('idtype.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('idtype.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\IdtypeStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(IdtypeStoreRequest $request)
    {
        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('idtypes.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Idtype  $idtype
     * @return \Illuminate\Http\Response
     */
    public function show(Idtype $idtype)
    {
        $item = $this->service->get($idtype);

        return view('idtype.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Idtype  $idtype
     * @return \Illuminate\Http\Response
     */
    public function edit(Idtype $idtype)
    {
        $item = $this->service->get($idtype);

        return view('idtype.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\IdtypeUpdateRequest  $request
     * @param  Idtype  $idtype
     * @return \Illuminate\Http\Response
     */
    public function update(IdtypeUpdateRequest $request, Idtype $idtype)
    {
        if ($request->isMethod('put')) {

            $this->service->update($idtype, $request->all());

            return redirect()->route('idtypes.show', $idtype);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Idtype  $idtype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Idtype $idtype)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($idtype);

            return redirect()->route('idtypes.index');
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
        $this->authorize('sync', Idtype::class);

        if ($this->service->sync()) {
            $this->success(200011);
        }

        return back();
    }
}
