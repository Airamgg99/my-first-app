<div class="flex items-center">
    <div class="flex items-center ms-3">
        <div>
            <button type="button" class="flex text-sm bg-[#FDC700] rounded-full text-[#1B3D73]" aria-expanded="false"
                data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Abrir Menú de Usuario</span>
                <x-phosphor-user-circle-light class="w-10 h-10" />
            </button>
        </div>
        <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow"
            id="dropdown-user">
            <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900" role="none">
                    {{ Auth::user()->name ?? '' }}
                </p>
                <p class="text-sm font-medium text-gray-900 truncate" role="none">
                    {{ Auth::user()->email ?? '' }}
                </p>
            </div>
            <ul class="py-1" role="none">
                <li>
                    <a href="" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        role="menuitem">Ajustes</a>
                </li>
                <li>
                    <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100"
                        role="menuitem">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</div>
