<?php

namespace App\Enums;

use Filament\Support\Colors\Color;
use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasLabel;

enum ApplicationStatus: string implements HasColor, HasLabel
{
    case Wishlist = 'wishlist';
    case Applied = 'applied';
    case Interview = 'interview';
    case Offer = 'offer';
    case Rejected = 'rejected';
    case Ghosted = 'ghosted';

    public function getLabel(): string
    {
        return match ($this) {
            self::Wishlist => 'Wishlist',
            self::Applied => 'Job Applied',
            self::Interview => 'Interview process',
            self::Offer => 'Offer Letter',
            self::Rejected => 'Rejected',
            self::Ghosted => 'Ghosted',
        };
    }

    public function getColor(): string|array
    {
        return match ($this) {
            self::Wishlist => Color::Indigo,
            self::Applied => 'info',
            self::Interview => 'warning',
            self::Offer => 'success',
            self::Rejected => 'danger',
            self::Ghosted => 'gray',

        };
    }
}
