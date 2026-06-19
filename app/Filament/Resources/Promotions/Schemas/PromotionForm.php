<?php

namespace App\Filament\Resources\Promotions\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class PromotionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('banner_path'),
                DateTimePicker::make('starts_at'),
                DateTimePicker::make('ends_at'),
                Toggle::make('is_active')
                    ->required(),
            ]);
    }
}
