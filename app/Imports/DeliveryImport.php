<?php

namespace App\Imports;

use Carbon\Carbon;
use ErrorException;
use App\Models\Archive;
use Maatwebsite\Excel\Row;
use App\Services\DeliveryService;
use Maatwebsite\Excel\Concerns\OnEachRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;
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
        $archiveId = Archive::whereSid($sid)->first()->id;

        $data = [
            'archive_id' => $archiveId,
            'receiver' => $row[7],
            'phone' => $row[8],
            'zipcode' => $row[9],
            'employment' => $row[10],
            'reasone' => $row[11],
            'ems' => $row[12],
            'send_at' => is_null($row[13]) ? null : $this->transformDateTime($row[13]),
            'remark' => $row[14],
            'version' => $this->deliveryService->getMaxVersion($archiveId) + 1,
        ];

        $this->deliveryService->store($data);
    }

    /**
     * @return int
     */
    public function startRow(): int
    {
        return 2;
    }

    protected function transformDateTime(string $value, string $format = 'Y-m-d')
    {
        try {
            return Carbon::instance(Date::excelToDateTimeObject($value))->format($format);
        } catch (ErrorException $e) {
            return Carbon::createFromFormat($format, $value);
        }
    }
}
