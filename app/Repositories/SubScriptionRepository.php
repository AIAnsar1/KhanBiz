<?php

namespace App\Repositories;

use App\Models\SubScription;

class SubScriptionRepository extends BaseRepository
{
    public function __construct(SubScription $model)
    {
        parent::__construct($model);
    }
}