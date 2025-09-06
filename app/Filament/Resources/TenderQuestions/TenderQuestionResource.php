<?php

namespace App\Filament\Resources\TenderQuestions;

use App\Filament\Resources\TenderQuestions\Pages\CreateTenderQuestion;
use App\Filament\Resources\TenderQuestions\Pages\EditTenderQuestion;
use App\Filament\Resources\TenderQuestions\Pages\ListTenderQuestions;
use App\Filament\Resources\TenderQuestions\Schemas\TenderQuestionForm;
use App\Filament\Resources\TenderQuestions\Tables\TenderQuestionsTable;
use App\Models\TenderQuestion;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TenderQuestionResource extends Resource
{
    protected static ?string $model = TenderQuestion::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TenderQuestionForm::configure($schema);
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
            'create' => CreateTenderQuestion::route('/create'),
            'edit' => EditTenderQuestion::route('/{record}/edit'),
        ];
    }
}
