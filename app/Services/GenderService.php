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

    public function getAll()
    {
        return $this->centerGenders->findAll();
    }

    public function sync()
    {
        $items = $this->centerGenders->findAll();

        foreach ($items as $item) {
            $attribute = [
                'id' => $item->dm,
                'name' => $item->mc,
                'is_enable' => 'zt' == 1 ? true : false,
            ];

            $this->repository->save($attribute);
        }
    }
}
