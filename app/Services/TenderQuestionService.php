<?php

namespace App\Services;

use App\Repositories\TenderQuestionRepository;

class TenderQuestionService extends BaseService
{
    public function __construct(TenderQuestionRepository $repository)
    {
        $this->repository = $repository;
    }
}