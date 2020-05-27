<?php

namespace App\Repositories;

use App\Models\Entry;

class EntryRepository extends Repository
{
    public function __construct(Entry $entry)
    {
        $this->model = $entry;
    }
}
