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

    protected ?string $maxHeight = '300px';

    protected function getData(): array
    {
        /** @var User $user */
        $user = Auth::user();

        $statuses = collect(ApplicationStatus::cases());

        $labels = $statuses->map(fn (ApplicationStatus $status) => $status->getLabel())->all();

        $counts = $statuses->map(fn (ApplicationStatus $status) => $user->applications()->where('status', $status)->count())->all();

        $colors = $statuses->map(fn (ApplicationStatus $status) => $status->getChartColor())->all();

        return [
            'datasets' => [
                [
                    'label' => 'Applications',
                    'data' => $counts,
                    'backgroundColor' => $colors,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'position' => 'right',
                    'labels' => ['usePointStyle' => true],
                ],
            ],
            'scales' => [
                'x' => ['display' => false],
                'y' => ['display' => false],
            ],
        ];
    }
}
