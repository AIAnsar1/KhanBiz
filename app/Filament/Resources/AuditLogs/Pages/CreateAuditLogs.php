<?php

namespace App\Filament\Resources\AuditLogs\Pages;

use App\Filament\Resources\AuditLogs\AuditLogsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAuditLogs extends CreateRecord
{
    protected static string $resource = AuditLogsResource::class;
}
