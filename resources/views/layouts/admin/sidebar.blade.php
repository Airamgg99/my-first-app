<ul class="space-y-2 font-medium">
    <li>
        <a href="{{ route('admin.calendar') }}"
            class="{{ str_starts_with(Route::currentRouteName(), 'admin') ? 'bg-[#02225A] text-white' : '' }} flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-5 group hover:text-[#02225A] hover:bg-[#FDC700]">
            <x-phosphor-calendar-dots-light
                class="{{ str_starts_with(Route::currentRouteName(), 'admin') ? 'text-white' : 'text-gray-900' }} flex-shrink-0 w-6 h-6 transition duration-75 group-hover:text-[#02225A] mr-2" />
            Calendar
        </a>
    </li>
    <li>
        <a href="{{ route('users.index') }}"
            class="{{ str_starts_with(Route::currentRouteName(), 'users') ? 'bg-[#02225A] text-white' : '' }} flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-5 group hover:text-[#02225A] hover:bg-[#FDC700]">
            <x-phosphor-users-three-light
                class="{{ str_starts_with(Route::currentRouteName(), 'users') ? 'text-white' : 'text-gray-900' }} flex-shrink-0 w-6 h-6 transition duration-75 group-hover:text-[#02225A] mr-2" />
            Users
        </a>
    </li>
    <li>
        <a href="{{ route('workplaces.index') }}"
            class="{{ str_starts_with(Route::currentRouteName(), 'workplaces') ? 'bg-[#02225A] text-white' : '' }} flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-5 group hover:text-[#02225A] hover:bg-[#FDC700]">
            <x-phosphor-building-light
                class="{{ str_starts_with(Route::currentRouteName(), 'workplaces') ? 'text-white' : 'text-gray-900' }} flex-shrink-0 w-6 h-6 transition duration-75 group-hover:text-[#02225A] mr-2" />
            Workplaces
        </a>
    </li>
    <li>
        <a href="{{ route('jobs.index') }}"
            class="{{ str_starts_with(Route::currentRouteName(), 'jobs') ? 'bg-[#02225A] text-white' : '' }} flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-5 group hover:text-[#02225A] hover:bg-[#FDC700]">
            <x-phosphor-suitcase-light
                class="{{ str_starts_with(Route::currentRouteName(), 'jobs') ? 'text-white' : 'text-gray-900' }} flex-shrink-0 w-6 h-6 transition duration-75 group-hover:text-[#02225A] mr-2" />
            Jobs
        </a>
    </li>
    <li>
        <a href="{{ route('contract_types.index') }}"
            class="{{ str_starts_with(Route::currentRouteName(), 'contract_types') ? 'bg-[#02225A] text-white' : '' }} flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-5 group hover:text-[#02225A] hover:bg-[#FDC700]">
            <x-phosphor-file-text-light
                class="{{ str_starts_with(Route::currentRouteName(), 'contract_types') ? 'text-white' : 'text-gray-900' }} flex-shrink-0 w-6 h-6 transition duration-75 group-hover:text-[#02225A] mr-2" />
            Contract types
        </a>
    </li>
</ul>
