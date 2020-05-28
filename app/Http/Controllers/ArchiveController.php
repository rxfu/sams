<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArchiveStoreRequest;
use App\Http\Requests\ArchiveUpdateRequest;
use App\Models\Archive;
use App\Services\ArchiveService;
use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\ArchiveService  $archiveService
     * @return void
     */
    public function __construct(ArchiveService $archiveService)
    {
        $this->authorizeResource(Archive::class, 'archive');

        $this->service = $archiveService;
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
}