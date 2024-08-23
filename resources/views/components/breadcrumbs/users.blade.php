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
            <a href="{{ route('users.index') }}"
                class="inline-flex items-center text-sm font-semibold text-[#02225A] hover:text-[#FDC700]">
                Users
            </a>
        </li>
        @if (request()->routeIs('users.create'))
            @include('components.graphics.arrow')
            <li>
                <span class="inline-flex items-center text-sm font-semibold text-[#02225A] hover:text-[#FDC700]">
                    Add User
                </span>
            </li>
        @elseif (request()->routeIs('users.edit'))
            @include('components.graphics.arrow')
            <li>
                <span class="inline-flex items-center text-sm font-semibold text-[#02225A] hover:text-[#FDC700]">
                    {{ $user->name }}
                </span>
            </li>
        @endif
    </ol>
</nav>
