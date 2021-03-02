<?php

namespace App\Repositories;

use App\Models\History;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class HistoryRepository extends Repository
{
    public function __construct(History $history)
    {
        $this->model = $history;
    }

    public function department()
    {
        try {
            return $this->model->select('department_id', 'department')
                ->groupBy('department_id', 'department')
                ->orderBy('department_id')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function major()
    {
        try {
            return $this->model->select('major_id', 'major', 'department_id', 'level')
                ->groupBy('major_id', 'major', 'department_id', 'level')
                ->orderBy('major_id')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function grade()
    {
        try {
            return $this->model->distinct()->select('grade')
                ->orderBy('grade', 'desc')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function level()
    {
        try {
            return $this->model->distinct()->select('level')
                ->orderBy('level')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}
