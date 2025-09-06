<?php

namespace App\Services;

use App\Repositories\ReportRepository;

class ReportService extends BaseService
{
    public function __construct(ReportRepository $repository)
    {
        $this->repository = $repository;
    }
}