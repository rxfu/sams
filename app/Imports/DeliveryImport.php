<?php

namespace App\Imports;

use App\Models\Archive;
use App\Models\Delivery;
use Maatwebsite\Excel\Row;
use App\Services\DeliveryService;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class DeliveryImport implements OnEachRow, WithHeadingRow
{
    protected $deliveryService;

    public function __construct(DeliveryService $deliveryService)
    {
        $this->deliveryService = $deliveryService;
    }
    /**
     * @param \Maatwebsite\Excel\Row $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function onRow(Row $row)
    {
        $rowIndex = $row->getIndex();
        $row = $row->toArray();

        $sid = $row['学号'];
        $forward = $row['投递去向'];
        $receiver = $row['收件人'];
        $phone = $row['联系电话'];
        $address = $row['地址'];
        $archiveId = Archive::whereSid($sid)->first()->archive_id;

        $this->deliveryService->store([
            'archive_id' => $archiveId,
            'forward' => $forward,
            'receiver' => $receiver,
            'phone' => $phone,
            'address' => $address,
        ]);
    }
}
