<x-filament-panels::page>
    @php($groups = $this->getApplicationsByStatus())

    <div style="display: grid; grid-template-columns: repeat(6, minmax(220px, 1fr)); gap: 1rem; overflow-x: auto;">
        @foreach (\App\Enums\ApplicationStatus::cases() as $status)
            <x-filament::section>
                <x-slot name="heading">
                    <x-filament::badge :color="$status->getColor()">{{ $status->getLabel() }}</x-filament::badge>
                </x-slot>

                @forelse ($groups[$status->value] ?? [] as $application)
                    <div style="padding: 0.5rem; margin-bottom: 0.5rem; border: 1px solid #e5e7eb; border-radius: 0.5rem;">
                    <strong>{{ $application->company_name }}</strong>
                    <div>{{ $application->job_role }}</div>
                    </div>
                @empty
                    <p style="color: #9ca3af;">No applications</p>
                @endforelse
            </x-filament::section>
        @endforeach
    </div>
</x-filament-panels::page>