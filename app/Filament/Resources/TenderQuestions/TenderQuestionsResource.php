<?php

namespace App\Filament\Resources\TenderQuestions;

use App\Filament\Resources\TenderQuestions\Pages\CreateTenderQuestions;
use App\Filament\Resources\TenderQuestions\Pages\EditTenderQuestions;
use App\Filament\Resources\TenderQuestions\Pages\ListTenderQuestions;
use App\Filament\Resources\TenderQuestions\Schemas\TenderQuestionsForm;
use App\Filament\Resources\TenderQuestions\Tables\TenderQuestionsTable;
use App\Models\TenderQuestions;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TenderQuestionsResource extends Resource
{
    protected static ?string $model = TenderQuestions::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TenderQuestionsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TenderQuestionsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListTenderQuestions::route('/'),
            'create' => CreateTenderQuestions::route('/create'),
            'edit' => EditTenderQuestions::route('/{record}/edit'),
        ];
    }
}
