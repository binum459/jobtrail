<x-filament-panels::page>
    @php($groups = $this->getApplicationsByStatus())

    <div style="display: grid; grid-template-columns: repeat(6, minmax(220px, 1fr)); gap: 1rem; overflow-x: auto;">
        @foreach (\App\Enums\ApplicationStatus::cases() as $status)
            <x-filament::section>
                <x-slot name="heading">
                    <div class="flex items-center justify-between">
                        <x-filament::badge :color="$status->getColor()">{{ $status->getLabel() }}</x-filament::badge>
                        <span class="text-sm text-gray-400">{{ count($groups[$status->value] ?? []) }}</span>
                    </div>
                </x-slot>

                <div
                    wire:sort="moveApplication"
                    wire:sort:group="applications"
                    wire:sort:group-id="{{ $status->value }}"
                    class="flex min-h-16 flex-col gap-2"
                >
                    @foreach ($groups[$status->value] ?? [] as $application)
                        <div
                            wire:key="application-{{ $application->id }}"
                            wire:sort:item="{{ $application->id }}"
                            class="cursor-grab rounded-xl border border-gray-200 bg-white p-3 shadow-sm transition hover:-translate-y-0.5 hover:shadow-md dark:border-white/10 dark:bg-gray-900"
                        >
                            <p class="font-semibold text-gray-950 dark:text-white">{{ $application->company_name }}</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $application->job_role }}</p>

                            <div class="mt-2 flex items-center justify-between text-xs text-gray-400">
                                <span>{{ $application->location ?? 'No location' }}</span>
                                <span>{{ $application->applied_on?->format('d M') ?? 'Not applied' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                @if (empty($groups[$status->value]))
                    <p class="rounded-xl border-2 border-dashed border-gray-200 p-4 text-center text-sm text-gray-400 dark:border-white/10">
                        No applications
                    </p>
                @endif
            </x-filament::section>
        @endforeach
    </div>
</x-filament-panels::page>