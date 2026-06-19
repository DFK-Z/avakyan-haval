<?php

namespace App\Filament\Resources\CarModels;

use App\Filament\Resources\CarModels\RelationManagers\GalleryItemsRelationManager;
use App\Filament\Resources\CarModels\RelationManagers\TrimsRelationManager;
use App\Filament\Resources\CarModels\Pages\CreateCarModel;
use App\Filament\Resources\CarModels\Pages\EditCarModel;
use App\Filament\Resources\CarModels\Pages\ListCarModels;
use App\Filament\Resources\CarModels\Schemas\CarModelForm;
use App\Filament\Resources\CarModels\Tables\CarModelsTable;
use App\Models\CarModel;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CarModelResource extends Resource
{
    protected static ?string $model = CarModel::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return CarModelForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CarModelsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            GalleryItemsRelationManager::class,
            TrimsRelationManager::class,
        ];
    }

    protected static ?string $navigationLabel = 'Автомобили';

    protected static ?string $modelLabel = 'модель';

    protected static ?string $pluralModelLabel = 'Модели';

    public static function getPages(): array
    {
        return [
            'index' => ListCarModels::route('/'),
            'create' => CreateCarModel::route('/create'),
            'edit' => EditCarModel::route('/{record}/edit'),
        ];
    }
}
