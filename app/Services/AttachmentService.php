<?php

namespace App\Services;

use App\Repositories\AttachmentRepository;

class AttachmentService extends BaseService
{
    public function __construct(AttachmentRepository $repository)
    {
        $this->repository = $repository;
    }
}