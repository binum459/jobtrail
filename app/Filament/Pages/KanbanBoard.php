<?php

namespace App\Filament\Pages;

use App\Enums\ApplicationStatus;
use App\Models\Application;
use App\Models\User;
use BackedEnum;
use Filament\Pages\Page;
use Filament\Support\Icons\Heroicon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function moveApplication(int $id, int $position, string $status): void
    {
        /** @var User $user */
        $user = Auth::user();

        $application = $user->applications()->findOrFail($id);

        DB::transaction(function () use ($user, $application, $status, $position) {
            // 1. Move the card to its new column (the observer records the history)
            $application->status = ApplicationStatus::from($status);
            $application->save();

            // 2. All OTHER cards in that column, in their current order
            $others = $user->applications()
                ->where('status', $status)
                ->where('id', '!=', $application->id)
                ->orderBy('position')
                ->get();

            // 3. Insert the moved card at its new place, then renumber 0, 1, 2…
            $others->splice($position, 0, [$application]);

            $others->values()->each(function (Application $item, int $index) {
                $item->position = $index;
                $item->save();
            });
        });
    }
}
