<?php

namespace App\Filament\Widgets;

use App\Enums\ApplicationStatus;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class ApplicationStats extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        /** @var User $user */
        $user = Auth::user();

        return [
            Stat::make('Total applications', $user->applications()->count())
                ->description('All jobs you are tracking'),

            Stat::make('Applied', $user->applications()->where('status', ApplicationStatus::Applied)->count())
                ->description('Waiting for a reply')
                ->color('info'),

            Stat::make('Interviews', $user->applications()->where('status', ApplicationStatus::Interview)->count())
                ->description('Prepare Well')
                ->color('warning'),

            Stat::make('Offers', $user->applications()->where('status', ApplicationStatus::Offer)->count())
                ->description('Congratulations')
                ->color('success'),
        ];
    }
}
