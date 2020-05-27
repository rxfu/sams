<?php

namespace App\Services;

use App\Repositories\EntryRepository;

class EntryService extends Service
{
    public function __construct(EntryRepository $entries)
    {
        $this->repository = $entries;
    }
}
