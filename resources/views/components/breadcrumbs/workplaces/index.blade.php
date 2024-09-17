<nav class="flex mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <x-breadcrumbs.home />
        <x-breadcrumbs.element icon="phosphor-building-light" text="Workplaces" :route="route('workplaces.index')" />
        {{ $slot }}
    </ol>
</nav>
