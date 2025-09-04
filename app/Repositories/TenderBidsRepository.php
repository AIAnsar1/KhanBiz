<?php

namespace App\Repositories;

use App\Models\TenderBids;

class TenderBidsRepository extends BaseRepository
{
    public function __construct(TenderBids $model)
    {
        parent::__construct($model);
    }
}