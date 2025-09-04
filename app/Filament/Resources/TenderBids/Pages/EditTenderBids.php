<?php

namespace App\Filament\Resources\TenderBids\Pages;

use App\Filament\Resources\TenderBids\TenderBidsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTenderBids extends EditRecord
{
    protected static string $resource = TenderBidsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
