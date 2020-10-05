<?php

namespace App\Repositories;

use App\Models\CenterMajor;

class CenterMajorRepository extends Repository
{
    public function __construct(CenterMajor $centerMajor)
    {
        $this->model = $centerMajor;
    }
}
