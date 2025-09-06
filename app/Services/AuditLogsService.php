<?php

namespace App\Services;

use App\Repositories\AuditLogsRepository;

class AuditLogsService extends BaseService
{
    public function __construct(AuditLogsRepository $repository)
    {
        $this->repository = $repository;
    }
}