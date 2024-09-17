<x-breadcrumbs.jobs.index>
    <x-breadcrumbs.element icon="phosphor-suitcase-light" :text="$job->name" :route="route('jobs.edit', $job->id)" />
    {{ $slot }}
</x-breadcrumbs.jobs.index>
