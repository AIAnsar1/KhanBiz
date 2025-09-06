<?php

namespace App\Filament\Resources\TenderQuestions\Pages;

use App\Filament\Resources\TenderQuestions\TenderQuestionsResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditTenderQuestions extends EditRecord
{
    protected static string $resource = TenderQuestionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
