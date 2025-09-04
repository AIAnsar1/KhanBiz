<?php

namespace App\Services;

use App\Repositories\TendersRepository;

class TendersService extends BaseService
{
    public function __construct(TendersRepository $repository)
    {
        $this->repository = $repository;
    }
}