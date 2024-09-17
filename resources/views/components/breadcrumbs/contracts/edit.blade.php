{{-- ! REVISAR POR QUÉ NO FUNCIONA ! --}}
<x-breadcrumbs.contracts.index>
    <x-breadcrumbs.element icon="phosphor-file-text-light" :text="$contract_type->name" :route="route('contract_types.edit', $contract_type->id)" />
    {{ $slot }}
</x-breadcrumbs.contracts.index>
