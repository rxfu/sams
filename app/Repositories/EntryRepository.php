<?php

namespace App\Repositories;

use App\Models\Entry;
use App\Exceptions\InternalException;
use Illuminate\Database\QueryException;

class EntryRepository extends Repository
{
    public function __construct(Entry $entry)
    {
        $this->model = $entry;
    }

    public function activeItems()
    {
        try {
            return $this->model->whereIsEnable(true)
                ->orderBy('order')
                ->get();
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }

    public function assignGroup($entry, $groups)
    {
        try {
            $entry->groups()->sync($groups);
        } catch (QueryException $e) {
            throw new InternalException($e, $this->getModel(), __FUNCTION__);
        }
    }
}
