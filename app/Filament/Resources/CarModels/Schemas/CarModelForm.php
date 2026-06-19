<?php

namespace App\Filament\Resources\CarModels\Schemas;

use App\Enums\CarCategory;
use App\Enums\DriveType;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CarModelForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('brand')
                    ->required()
                    ->default('Haval'),
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Select::make('category')
                    ->options(CarCategory::class)
                    ->required(),
                Select::make('drive_type')
                    ->options(DriveType::class)
                    ->required(),
                TextInput::make('price_from')
                    ->required()
                    ->numeric(),
                KeyValue::make('specs')
                    ->keyLabel('Параметр')
                    ->valueLabel('Значение')
                    ->columnSpanFull(),
                TextInput::make('seats')
                    ->numeric(),
                TextInput::make('doors')
                    ->numeric(),
                TextInput::make('transmission'),
                FileUpload::make('hero_image')
                    ->image(),
                TextInput::make('meta_title'),
                Textarea::make('meta_description')
                    ->columnSpanFull(),
                Toggle::make('is_active')
                    ->required(),
                Toggle::make('is_popular')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
