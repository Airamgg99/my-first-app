<nav class="flex pb-3 text-gray-700">
    <ol class="inline-flex items-center space-x-1 md:space-x-1 mb-0.5 rtl:space-x-reverse">
        <li>
            <a href="{{ route('index') }}"
                class="inline-flex items-center text-sm font-semibold text-[#02225A] hover:text-[#FDC700] pt-1">
                <x-phosphor-house-fill class="w-3 h-3 mr-1" />
                Home
            </a>
        </li>
        @include('components.graphics.arrow')
        <li>
            <a href="{{ route('contract_types.index') }}"
                class="inline-flex items-center text-sm font-semibold text-[#02225A] hover:text-[#FDC700]">
                Contract types
            </a>
        </li>
        @if (request()->routeIs('contract_types.create'))
            @include('components.graphics.arrow')
            <li>
                <span class="inline-flex items-center text-sm font-semibold text-[#02225A] hover:text-[#FDC700]">
                    Add Contract type
                </span>
            </li>
        @elseif (request()->routeIs('contract_types.edit'))
            @include('components.graphics.arrow')
            <li>
                <span class="inline-flex items-center text-sm font-semibold text-[#02225A] hover:text-[#FDC700]">
                    {{ $contract_type->name }}
                </span>
            </li>
        @endif
    </ol>
</nav>
