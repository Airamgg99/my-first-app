<x-breadcrumbs.workplaces.index>
    <x-breadcrumbs.element icon="phosphor-building-light" :text="$workplace->name" :route="route('workplaces.edit', $workplace->id)" />
    {{ $slot }}
</x-breadcrumbs.workplaces.index>
