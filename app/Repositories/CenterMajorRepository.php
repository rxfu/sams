<?php

namespace App\Repositories;

use App\Models\CenterMajor;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class CenterMajorRepository extends Repository
{
    public function __construct(CenterMajor $centerMajor)
    {
        $this->model = $centerMajor;
    }

    public function allLevels()
    {
        try {
            return $this->model->distinct()
                ->select('sjly AS level')
                ->orderBy('sjly')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}
