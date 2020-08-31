<?php

namespace App\Http\Controllers;

use App\Http\Requests\EntryStoreRequest;
use App\Http\Requests\EntryUpdateRequest;
use App\Models\Entry;
use App\Services\EntryService;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\EntryService  $entryService
     * @return void
     */
    public function __construct(EntryService $entryService)
    {
        $this->authorizeResource(Entry::class, 'entry');

        $this->service = $entryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = $this->service->getAll();

        return view('entry.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('entry.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\EntryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EntryStoreRequest $request)
    {
        if ($request->isMethod('post')) {

            $item = $this->service->store($request->all());

            return redirect()->route('entries.show', $item);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function show(Entry $entry)
    {
        $item = $this->service->get($entry);

        return view('entry.show', compact('item'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function edit(Entry $entry)
    {
        $item = $this->service->get($entry);

        return view('entry.edit', compact('item'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\EntryUpdateRequest  $request
     * @param  Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function update(EntryUpdateRequest $request, Entry $entry)
    {
        if ($request->isMethod('put')) {

            $this->service->update($entry, $request->all());

            return redirect()->route('entries.show', $entry);
        }

        $this->error(405001);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Entry $entry)
    {
        if ($request->isMethod('delete')) {

            $this->service->delete($entry);

            return redirect()->route('entries.index');
        }

        $this->error(405001);

        return back();
    }

    /**
     * Show the form for assigning the specified resource.
     *
     * @param  Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function showGroupForm(Entry $entry)
    {
        $this->authorize('group', $entry);

        $item = $this->service->get($entry);
        $assignedGroups = $this->service->getAssignedGroups($item);

        return view('entry.group', compact('item', 'assignedGroups'));
    }

    /**
     * Assign the specified group in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  Entry  $entry
     * @return \Illuminate\Http\Response
     */
    public function assignGroup(Request $request, Entry $entry)
    {
        $this->authorize('group', $entry);

        if ($request->isMethod('post')) {

            $this->service->assignGroup($entry, $request->groups);

            return redirect()->route('entries.index');
        }

        $this->error(405001);

        return back();
    }
}
