<?php

namespace App\Filament\Resources\Tenders;

use App\Filament\Resources\Tenders\Pages\CreateTenders;
use App\Filament\Resources\Tenders\Pages\EditTenders;
use App\Filament\Resources\Tenders\Pages\ListTenders;
use App\Filament\Resources\Tenders\Schemas\TendersForm;
use App\Filament\Resources\Tenders\Tables\TendersTable;
use App\Models\Tenders;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TendersResource extends Resource
{
    protected static ?string $model = Tenders::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TendersForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TendersTable::configure($table);
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
            'index' => ListTenders::route('/'),
            'create' => CreateTenders::route('/create'),
            'edit' => EditTenders::route('/{record}/edit'),
        ];
    }
}
