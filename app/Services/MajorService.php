<?php

namespace App\Services;

use App\Repositories\MajorRepository;

class MajorService extends Service
{
    public function __construct(MajorRepository $majors)
    {
        $this->repository = $majors;
    }
}
