<?php

namespace App\Repositories;

use App\Models\Tenders;

class TendersRepository extends BaseRepository
{
    public function __construct(Tenders $model)
    {
        parent::__construct($model);
    }
}