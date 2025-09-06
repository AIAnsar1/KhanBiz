<?php

namespace App\Services;

use App\Repositories\SubScriptionRepository;

class SubScriptionService extends BaseService
{
    public function __construct(SubScriptionRepository $repository)
    {
        $this->repository = $repository;
    }
}