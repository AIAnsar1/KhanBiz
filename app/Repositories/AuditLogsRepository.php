<?php

namespace App\Repositories;

use App\Models\AuditLogs;

class AuditLogsRepository extends BaseRepository
{
    public function __construct(AuditLogs $model)
    {
        parent::__construct($model);
    }
}