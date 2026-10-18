<?php

namespace App\Filament\Pages;

use App\Models\Application;
use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class KanbanBoard extends Page
{
    protected string $view = 'filament.pages.kanban-board';

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedViewColumns;

    public function getApplicationsByStatus(): Collection
    {
        /** @var User $user */
        $user = Auth::user();

        return $user->applications()
            ->orderBy('position')
            ->get()
            ->groupBy(fn (Application $application) => $application->status->value);
    }
}
