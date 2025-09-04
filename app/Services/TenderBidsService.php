<?php

namespace App\Services;

use App\Repositories\TenderBidsRepository;

class TenderBidsService extends BaseService
{
    public function __construct(TenderBidsRepository $repository)
    {
        $this->repository = $repository;
    }
}