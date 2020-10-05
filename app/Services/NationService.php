<?php

namespace App\Services;

use App\Repositories\CenterNationRepository;
use App\Repositories\NationRepository;

class NationService extends Service
{
    protected $centerNations;

    public function __construct(NationRepository $nations, CenterNationRepository $centerNations)
    {
        $this->repository = $nations;
        $this->centerNations = $centerNations;
    }

    public function sync()
    {
        $items = $this->centerNations->findAll();

        foreach ($items as $item) {
            $attributes = [
                'id' => $item->dm,
            ];

            $values = [
                'name' => $item->mc,
                'slug' => $item->zmdm,
                'is_enable' => $item->zt == 1 ? true : false,
            ];

            $this->repository->updateOrCreate($attributes, $values);
        }

        return true;
    }
}
