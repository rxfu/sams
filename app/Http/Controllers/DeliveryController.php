<?php

namespace App\Http\Controllers;

use App\Http\Requests\DeliveryStoreRequest;
use App\Http\Requests\DeliveryUpdateRequest;
use App\Models\Delivery;
use App\Services\DeliveryService;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @param \App\Services\DeliveryService  $deliveryService
     * @return void
     */
    public function __construct(DeliveryService $deliveryService)
    {
        $this->authorizeResource(Delivery::class, 'delivery');

        $this->service = $deliveryService;
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
}
