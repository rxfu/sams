<?php

namespace App\Repositories;

use App\Models\Archive;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class ArchiveRepository extends Repository
{
    public function __construct(Archive $archive)
    {
        $this->model = $archive;
    }

    public function findBySid($sid)
    {
        try {
            return $this->model->whereSid($sid)->first();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function getAllByStudentsQuery($sid)
    {
        try {
            $ids = is_array($sid) ? $sid : [$sid];

            return $this->model->with('student')->whereIn('sid', $ids);
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function getAllByStudents($sid)
    {
        try {
            return $this->getAllByStudentsQuery($sid)->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}
