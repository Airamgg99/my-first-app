<ul class="space-y-2 pt-3 font-medium">
    <li>
        <a href="{{ route('user.calendar') }}"
            class="{{ str_starts_with(Route::currentRouteName(), 'user') ? 'bg-[#02225A] text-white' : '' }} flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-5 group hover:text-[#02225A] hover:bg-[#FDC700]">
            <x-phosphor-calendar-dots-light
                class="{{ str_starts_with(Route::currentRouteName(), 'user') ? 'text-white' : 'text-gray-900' }} flex-shrink-0 w-6 h-6 transition duration-75 group-hover:text-[#02225A] mr-2" />
            Calendar
        </a>
    </li>
</ul>
