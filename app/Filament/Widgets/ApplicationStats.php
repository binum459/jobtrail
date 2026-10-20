<?php

namespace App\Filament\Widgets;

use App\Enums\ApplicationStatus;
use App\Models\User;
use Filament\Support\Icons\Heroicon;
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
        $lastSevenDays = collect(range(6, 0))
            ->map(fn (int $daysAgo) => $user->applications()->whereDate('created_at', now()->subDays($daysAgo))->count())
            ->all();

        return [
            Stat::make('Total applications', $user->applications()->count())
                ->description('All jobs you are tracking')
                ->icon(Heroicon::OutlinedBriefcase)
                ->descriptionIcon(Heroicon::ArrowTrendingUp)
                ->color('primary')
                ->chart($lastSevenDays),
            Stat::make('Applied', $user->applications()->where('status', ApplicationStatus::Applied)->count())
                ->description('Waiting for a reply')
                ->color('info')
                ->icon(Heroicon::OutlinedPaperAirplane),
            Stat::make('Interviews', $user->applications()->where('status', ApplicationStatus::Interview)->count())
                ->description('Prepare Well')
                ->color('warning')
                ->icon(Heroicon::OutlinedChatBubbleLeftRight),
            Stat::make('Offers', $user->applications()->where('status', ApplicationStatus::Offer)->count())
                ->description('Congratulations')
                ->color('success')
                ->icon(Heroicon::OutlinedTrophy),
        ];
    }
}
