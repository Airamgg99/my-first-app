<nav class="flex mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        <x-breadcrumbs.home />
        <x-breadcrumbs.element icon="phosphor-file-text-light" text="Contract Types" :route="route('contract_types.index')" />
        {{ $slot }}
    </ol>
</nav>
