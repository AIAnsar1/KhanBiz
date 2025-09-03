<?php

namespace App\Repositories;

use App\Models\Companies;

class CompaniesRepository extends BaseRepository
{
    public function __construct(Companies $model)
    {
        parent::__construct($model);
    }
}