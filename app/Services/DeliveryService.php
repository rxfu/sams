<?php

namespace App\Services;

use App\Repositories\ArchiveRepository;
use Illuminate\Support\Facades\Auth;
use App\Repositories\StudentRepository;
use App\Repositories\DeliveryRepository;
use Illuminate\Support\Arr;

class DeliveryService extends Service
{
    protected $studentRepository;

    protected $archiveRepository;

    public function __construct(DeliveryRepository $deliveries, StudentRepository $studentRepository, ArchiveRepository $archiveRepository)
    {
        $this->repository = $deliveries;
        $this->studentRepository = $studentRepository;
        $this->archiveRepository = $archiveRepository;
    }

    public function store($data)
    {
        $data['creator_id'] = Auth::id();
        $data['editor_id'] = Auth::id();
        $data['version'] = $this->repository->maxVersion($data['archive_id']) + 1;

        return $this->repository->save($data);
    }

    protected function getSearchQuery($attributes, $relations, $orders, $trashed)
    {
        $students = $this->studentRepository->allStudentsBy($attributes, $relations, $orders, $trashed);

        $archives = $this->archiveRepository->getAllByStudents($students->pluck('id')->toArray());

        return $this->repository->getAllByArchives($archives->pluck('id')->toArray());
    }

    public function getMaxVersion($archiveId)
    {
        return $this->repository->maxVersion($archiveId);
    }

    public function getDelivered($attributes)
    {
        $students = $this->studentRepository->allStudentsBy($attributes, null, null, false);

        $archives = $this->archiveRepository->getAllByStudents($students->pluck('id')->toArray());

        return $this->repository->getDeliveredByArchives($archives->pluck('id')->toArray())->get();
    }

    public function getAllByStatus($attributes, $delivered = true)
    {
        $status = $delivered ? '1' : '0';
        $studentAttributes = Arr::except($attributes, ['send_at']);
        $sendAt = $attributes['send_at'];

        $students = $this->studentRepository->allStudentsBy($studentAttributes, null, null, false);

        $archives = $this->archiveRepository->getAllByStudents($students->pluck('id')->toArray());

        return $this->repository->getAllBySendAtAndStatus($archives->pluck('id')->toArray(), $sendAt, $status);
    }

    public function sent($deliveries)
    {
        $data['status'] = '1';

        foreach ($deliveries as $delivery) {
            $this->update($delivery, $data);
        }
    }
}
