<?php

namespace App\Filament\Resources\Applications\Schemas;

use App\Enums\ApplicationStatus;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ApplicationForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                TextInput::make('company_name')
                    ->required(),
                TextInput::make('job_role')
                    ->required(),
                TextInput::make('location')
                    ->default(null),
                TextInput::make('salary')
                    ->default(null),
                TextInput::make('job_source')
                    ->default(null),
                TextInput::make('job_url')
                    ->url()
                    ->default(null),
                DatePicker::make('applied_on'),
                Select::make('status')
                    ->options(ApplicationStatus::class)
                    ->default('wishlist')
                    ->required(),
                Textarea::make('notes')
                    ->default(null)
                    ->columnSpanFull(),
            ]);
    }
}
