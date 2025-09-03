<?php

namespace App\Services;

use App\Repositories\CompaniesRepository;

class CompaniesService extends BaseService
{
    public function __construct(CompaniesRepository $repository)
    {
        $this->repository = $repository;
    }
}