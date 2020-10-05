<?php

namespace App\Services;

use App\Repositories\CenterMajorRepository;

class CenterMajorService extends Service
{
    public function __construct(CenterMajorRepository $centerMajors)
    {
        $this->repository = $centerMajors;
    }
}
