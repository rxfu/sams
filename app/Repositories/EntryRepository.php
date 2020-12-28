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

    public function activeItems($groupId = null)
    {
        try {
            $model = $this->model;
            if (!is_null($groupId)) {
                $model = $model->whereHas('groups', function ($query) use ($groupId) {
                    $query->whereId($groupId);
                });
            }
            return $model->whereIsEnable(true)
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
