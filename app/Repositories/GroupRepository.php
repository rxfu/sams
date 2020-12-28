<?php

namespace App\Repositories;

use App\Models\Group;

class GroupRepository extends Repository
{
    public function __construct(Group $group)
    {
        $this->model = $group;
    }

    public function slug($slug)
    {
        return $this->queryBy([
            'slug' => $slug
        ])->first();
    }
}
