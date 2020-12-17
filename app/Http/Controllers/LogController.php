<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Services\LogService;
use Illuminate\Http\Request;

class LogController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\LogService  $logService
     * @return void
     */
    public function __construct(LogService $logService)
    {
        $this->authorizeResource(Log::class, 'log');

        $this->service = $logService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = $this->service->search(null, 10, null, ['created_at' => 'desc']);

        return view('log.index', compact('items'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Log  $log
     * @return \Illuminate\Http\Response
     */
    public function show(Log $log)
    {
        $item = $this->service->get($log);

        return view('log.show', compact('item'));
    }
}
