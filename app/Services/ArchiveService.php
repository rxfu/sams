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

    public function getBySid($sid)
    {
        return $this->repository->findBySid($sid);
    }

    public function store($data)
    {
        $userId = Auth::id();
        $data['id'] = date('YmdHis') . random_int(10000, 99999);
        $data['creator_id'] = $userId;
        $data['editor_id'] = $userId;

        $entries = array_map(function ($number) use ($userId) {
            return [
                'quantity' => $number ?? 0,
                'creator_id' => $userId,
                'editor_id' => $userId,
            ];
        }, $data['entry']);

        $archive = $this->repository->save($data);
        $archive->entries()->sync($entries);

        return $archive;
    }

    public function update($model, $data)
    {
        $userId = Auth::id();
        $data['editor_id'] = $userId;

        $entries = array_map(function ($number) use ($userId) {
            return [
                'quantity' => $number ?? 0,
                'editor_id' => $userId,
            ];
        }, $data['entry']);

        $archive = $this->repository->update($model->getKey(), $data);
        $archive->entries()->sync($entries);

        return $archive;
    }
}
