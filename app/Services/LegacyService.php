<?php

namespace App\Services;

use App\Repositories\LegacyRepository;

class LegacyService extends Service
{
    public function __construct(LegacyRepository $legacies)
    {
        $this->repository = $legacies;
    }
}
