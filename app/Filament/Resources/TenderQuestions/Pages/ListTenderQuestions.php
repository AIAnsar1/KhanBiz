<?php

namespace App\Filament\Resources\TenderQuestions\Pages;

use App\Filament\Resources\TenderQuestions\TenderQuestionsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTenderQuestions extends ListRecords
{
    protected static string $resource = TenderQuestionsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
