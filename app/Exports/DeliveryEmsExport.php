<?php

namespace App\Exports;

use App\Models\Delivery;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class DeliveryEmsExport implements FromView
{
    /**
     * @return View
     */
    public function view(): View
    {
        $deliveries = Delivery::all();

        return view('exports.delivery-ems', compact('deliveries'));
    }
}
