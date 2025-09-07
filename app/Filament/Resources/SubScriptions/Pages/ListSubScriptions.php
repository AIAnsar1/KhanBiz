<?php

namespace App\Filament\Resources\SubScriptions\Pages;

use App\Filament\Resources\SubScriptions\SubScriptionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSubScriptions extends ListRecords
{
    protected static string $resource = SubScriptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
