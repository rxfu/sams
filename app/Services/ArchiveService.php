<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\ArchiveRepository;

class ArchiveService extends Service
{
    public function __construct(ArchiveRepository $archives)
    {
        $this->repository = $archives;
    }

    public function store($data)
    {
        $data['id'] = date('YmdHis') . random_int(10000, 99999);
        $data['creator_id'] = Auth::id();
        $data['editor_id'] = Auth::id();

        $entries = array_map(function ($number) {
            return [
                'quantity' => $number,
                'creator_id' => Auth::id(),
                'editor_id' => Auth::id(),
            ];
        }, $data['entry']);

        $archive = $this->repository->save($data);
        $archive->entries()->sync($entries);

        return $archive;
    }

    public function update($model, $data)
    {
        $data['editor_id'] = Auth::id();

        $entries = array_map(function ($number) {
            return [
                'quantity' => $number,
                'editor_id' => Auth::id(),
            ];
        }, $data['entry']);

        $archive = $this->repository->update($model->getKey(), $data);
        $archive->entries()->sync($entries);

        return $archive;
    }
}
