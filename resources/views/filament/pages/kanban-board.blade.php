<x-filament-panels::page>
    @php($groups = $this->getApplicationsByStatus())

    <div style="display: grid; grid-template-columns: repeat(6, minmax(220px, 1fr)); gap: 1rem; overflow-x: auto;">
        @foreach (\App\Enums\ApplicationStatus::cases() as $status)
            <x-filament::section>
                <x-slot name="heading">
                    <x-filament::badge :color="$status->getColor()">{{ $status->getLabel() }}</x-filament::badge>
                </x-slot>

             
                    <div
                        wire:sort="moveApplication"
                        wire:sort:group="applications"
                        wire:sort:group-id="{{ $status->value }}"
                        style="min-height: 4rem;"
>
    @foreach ($groups[$status->value] ?? [] as $application)
        <div
            wire:key="application-{{ $application->id }}"
            wire:sort:item="{{ $application->id }}"
            style="padding: 0.5rem; margin-bottom: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.5rem; cursor: grab;">
            <strong>{{ $application->company_name }}</strong>
            <div>{{ $application->job_role }}</div>
        </div>
    @endforeach
</div>

@if (empty($groups[$status->value]))
    <p style="color: #9ca3af;">No applications</p>
@endif       
            </x-filament::section>
        @endforeach
    </div>   
</x-filament-panels::page>