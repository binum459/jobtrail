<?php

namespace App\Filament\Widgets;

use App\Enums\ApplicationStatus;
use App\Models\User;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\Auth;

class ApplicationsByStatusChart extends ChartWidget
{
    protected static ?int $sort = 2;

    protected ?string $heading = 'Applications By Status';

    protected function getData(): array
    {
        /** @var User $user */
        $user = Auth::user();

        $statuses = collect(ApplicationStatus::cases());

        $labels = $statuses->map(fn (ApplicationStatus $status) => $status->getLabel())->all();

        $counts = $statuses->map(fn (ApplicationStatus $status) => $user->applications()->where('status', $status)->count())->all();

        return [
            'datasets' => [
                [
                    'label' => 'Applications',
                    'data' => $counts,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
