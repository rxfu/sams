<?php

namespace App\Repositories;

use App\Models\Archive;

class ArchiveRepository extends Repository
{
    public function __construct(Archive $archive)
    {
        $this->model = $archive;
    }

    public function findBySid($sid)
    {
        return $this->model->whereSid($sid)->first();
    }
}
