<?php

namespace App\Observers;

use App\Models\Application;

class ApplicationObserver
{
    /**
     * Handle the Application "created" event.
     */
    public function created(Application $application): void
    {
        $application->statusChanges()->create([
            'from_status' => null,
            'to_status' => $application->status,
            'changed_at' => now(),
        ]);
    }

    /**
     * Handle the Application "updated" event.
     */
    public function updated(Application $application): void
    {
        if ($application->wasChanged('status')) {
            $application->statusChanges()->create([
                'from_status' => $application->getOriginal('status'),
                'to_status' => $application->status,
                'changed_at' => now(),
            ]);
        }
    }
}
