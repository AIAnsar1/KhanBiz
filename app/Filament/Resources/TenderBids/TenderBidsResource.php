<?php

namespace App\Filament\Resources\TenderBids;

use App\Filament\Resources\TenderBids\Pages\CreateTenderBids;
use App\Filament\Resources\TenderBids\Pages\EditTenderBids;
use App\Filament\Resources\TenderBids\Pages\ListTenderBids;
use App\Filament\Resources\TenderBids\Schemas\TenderBidsForm;
use App\Filament\Resources\TenderBids\Tables\TenderBidsTable;
use App\Models\TenderBids;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TenderBidsResource extends Resource
{
    protected static ?string $model = TenderBids::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TenderBidsForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TenderBidsTable::configure($table);
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
            'index' => ListTenderBids::route('/'),
            'create' => CreateTenderBids::route('/create'),
            'edit' => EditTenderBids::route('/{record}/edit'),
        ];
    }
}
