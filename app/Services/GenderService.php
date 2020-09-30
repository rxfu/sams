<?php

namespace App\Services;

use App\Repositories\CenterGenderRepository;
use App\Repositories\GenderRepository;

class GenderService extends Service
{
    protected $centerGenders;

    public function __construct(GenderRepository $genders, CenterGenderRepository $centerGenders)
    {
        $this->repository = $genders;
        $this->centerGenders = $centerGenders;
    }

    public function sync()
    {
        $items = $this->centerGenders->findAll();

        foreach ($items as $item) {
            $attributes = [
                'id' => $item->dm,
            ];

            $values = [
                'name' => $item->mc,
                'is_enable' => $item->zt == 1 ? true : false,
            ];

            $this->repository->updateOrCreate($attributes, $values);
        }

        return true;
    }
}
