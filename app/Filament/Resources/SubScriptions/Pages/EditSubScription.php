<?php

namespace App\Filament\Resources\SubScriptions\Pages;

use App\Filament\Resources\SubScriptions\SubScriptionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditSubScription extends EditRecord
{
    protected static string $resource = SubScriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
