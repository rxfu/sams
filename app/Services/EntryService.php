<?php

namespace App\Services;

use App\Repositories\EntryRepository;

class EntryService extends Service
{
    public function __construct(EntryRepository $entries)
    {
        $this->repository = $entries;
    }

    public function getActiveItems($groupId = null)
    {
        return $this->repository->activeItems($groupId);
    }

    public function assignGroup($entry, $groups)
    {
        $entry = $this->repository->find($entry->getKey());

        $this->repository->assignGroup($entry, $groups);
    }

    public function getAssignedGroups($entry)
    {
        $entry = $this->repository->find($entry->getKey());

        return $entry->groups->pluck('id')->toArray();
    }
}
