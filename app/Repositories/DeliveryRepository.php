<?php

namespace App\Repositories;

use App\Models\Delivery;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class DeliveryRepository extends Repository
{
    public function __construct(Delivery $delivery)
    {
        $this->model = $delivery;
    }

    public function maxVersion($archiveId)
    {
        try {
            return $this->model->whereArchiveId($archiveId)->max('version') ?? 0;
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function getAllByArchives($aid)
    {
        try {
            $ids = is_array($aid) ? $aid : [$aid];

            return $this->model->with(['archive', 'archive.student'])->whereIn('archive_id', $ids);
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}
