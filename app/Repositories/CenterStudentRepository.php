<?php

namespace App\Repositories;

use App\Models\CenterStudent;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class CenterStudentRepository extends Repository
{
    public function __construct(CenterStudent $centerStudent)
    {
        $this->model = $centerStudent;
    }

    public function allGrades()
    {
        try {
            return $this->model->distinct()
                ->select('dqszj AS grade')
                ->orderBy('dqszj')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
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
