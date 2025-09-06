<?php

namespace App\Repositories;

use App\Models\TenderQuestion;

class TenderQuestionRepository extends BaseRepository
{
    public function __construct(TenderQuestion $model)
    {
        parent::__construct($model);
    }
}