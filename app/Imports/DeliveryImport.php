<?php

namespace App\Imports;

use App\Models\Archive;
use Maatwebsite\Excel\Row;
use App\Services\DeliveryService;
use Maatwebsite\Excel\Concerns\OnEachRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class DeliveryImport implements OnEachRow, WithStartRow
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

        $sid = $row[0];
        $forward = $row[1];
        $receiver = $row[2];
        $phone = $row[3];
        $address = $row[4];
        $remark = $row[5];
        $archiveId = Archive::whereSid($sid)->first()->id;

        $this->deliveryService->store([
            'archive_id' => $archiveId,
            'forward' => $forward,
            'receiver' => $receiver,
            'phone' => $phone,
            'address' => $address,
            'remark' => $remark,
        ]);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }
}
