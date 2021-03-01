<?php

namespace App\Repositories;

use App\Models\LegacyStudent;

class LegacyRepository extends Repository
{
    public function __construct(LegacyStudent $legacy)
    {
        $this->model = $legacy;
    }
}
