<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Register as BaseRegister;
use Illuminate\Contracts\Support\Htmlable;

class Register extends BaseRegister
{
    public function getHeading(): string|Htmlable|null
    {
        return 'Create your account';
    }

    public function getTitle(): string|Htmlable
    {
        return 'Sign up';
    }
}
