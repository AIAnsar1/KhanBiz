<?php

namespace App\Services;

use App\Repositories\PlanRepository;

class PlanService extends BaseService
{
    public function __construct(PlanRepository $repository)
    {
        $this->repository = $repository;
    }
}