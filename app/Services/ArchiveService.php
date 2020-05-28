<?php

namespace App\Services;

use App\Repositories\ArchiveRepository;

class ArchiveService extends Service
{
    public function __construct(ArchiveRepository $archives)
    {
        $this->repository = $archives;
    }
}
