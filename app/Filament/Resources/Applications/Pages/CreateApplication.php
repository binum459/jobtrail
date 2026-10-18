<?php

namespace App\Filament\Resources\Applications\Pages;

use App\Filament\Resources\Applications\ApplicationResource;
use App\Models\User;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CreateApplication extends CreateRecord
{
    protected static string $resource = ApplicationResource::class;

    protected function handleRecordCreation(array $data): Model
    {
        /** @var User $user */
        $user = Auth::user();

        return $user->applications()->create($data);

    }
}
