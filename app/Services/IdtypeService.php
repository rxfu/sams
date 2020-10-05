<?php

namespace App\Services;

use App\Repositories\CenterIdtypeRepository;
use App\Repositories\IdtypeRepository;

class IdtypeService extends Service
{
    protected $centerIdtypes;

    public function __construct(IdtypeRepository $idtypes, CenterIdtypeRepository $centerIdtypes)
    {
        $this->repository = $idtypes;
        $this->centerIdtypes = $centerIdtypes;
    }

    public function sync()
    {
        $items = $this->centerIdtypes->findAll();

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
