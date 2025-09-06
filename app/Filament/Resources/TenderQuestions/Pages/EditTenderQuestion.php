<?php

namespace App\Filament\Resources\TenderQuestions\Pages;

use App\Filament\Resources\TenderQuestions\TenderQuestionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTenderQuestion extends EditRecord
{
    protected static string $resource = TenderQuestionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
