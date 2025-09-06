<?php

namespace App\Services;

use App\Repositories\MessageRepository;

class MessageService extends BaseService
{
    public function __construct(MessageRepository $repository)
    {
        $this->repository = $repository;
    }
}