<?php

namespace App\Filament\Resources\SubScriptions;

use App\Filament\Resources\SubScriptions\Pages\CreateSubScription;
use App\Filament\Resources\SubScriptions\Pages\EditSubScription;
use App\Filament\Resources\SubScriptions\Pages\ListSubScriptions;
use App\Filament\Resources\SubScriptions\Schemas\SubScriptionForm;
use App\Filament\Resources\SubScriptions\Tables\SubScriptionsTable;
use App\Models\SubScription;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SubScriptionResource extends Resource
{
    protected static ?string $model = SubScription::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SubScriptionForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SubScriptionsTable::configure($table);
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
            'index' => ListSubScriptions::route('/'),
            'create' => CreateSubScription::route('/create'),
            'edit' => EditSubScription::route('/{record}/edit'),
        ];
    }
}
