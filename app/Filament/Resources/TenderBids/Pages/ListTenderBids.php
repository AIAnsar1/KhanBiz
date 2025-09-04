<?php

namespace App\Filament\Resources\TenderBids\Pages;

use App\Filament\Resources\TenderBids\TenderBidsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTenderBids extends ListRecords
{
    protected static string $resource = TenderBidsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
