<div>
    <div>
        <x-breadcrumbs.users.index />
        <div class="sm:rounded-lg relative overflow-hidden">
            <div class="flex flex-col sm:flex-row align-center justify-between space-y-3 sm:space-y-0 sm:space-x-3 pb-3">
                <div class="justify-start">
                    <x-buttons.add :route="route('users.create')" text="Add user" />
                    <x-buttons.download />
                </div>
                @include('components.inputs.select', [
                    'name' => 'role_id',
                    'id' => 'role',
                    'wire' => 'role_id',
                    'text' => 'Select a role',
                    'elements' => App\Models\Roles\Role::orderBy('role')->get(),
                    'option' => 'role',
                    'label' => 'role',
                    'inside' => 'Roles',
                ])
                @include('components.inputs.select', [
                    'name' => 'status_id',
                    'id' => 'status',
                    'wire' => 'status_id',
                    'text' => 'Select a status',
                    'elements' => App\Models\Statuses\Status::orderBy('status')->get(),
                    'option' => 'status',
                    'label' => 'status',
                    'inside' => 'Status',
                ])
                <div class="flex items-center space-x-2">
                    <label for="showDeleted" class="text-sm font-medium text-gray-700">Deleted Users</label>
                    <input type="checkbox" id="showDeleted" wire:model="showDeleted" class="form-checkbox">
                </div>
                <x-inputs.search search="User search" />
            </div>
            <div class="overflow-x-auto">
                @if ($showDeleted)
                    {{-- Tabla para usuarios eliminados --}}
                    <div class="hidden md:block">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-[#FDC700] uppercase bg-[#1B3D73]">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-center">Name</th>
                                    <th scope="col" class="px-4 py-3 text-center">Email</th>
                                    <th scope="col" class="px-4 py-3 text-center">Role</th>
                                    <th scope="col" class="px-4 py-3 text-center">Status</th>
                                    <th scope="col" class="px-4 py-3 text-center">Deleted At</th>
                                    <th scope="col" class="px-4 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 text-center">{{ $user->name }}</td>
                                        <td class="px-6 py-4 text-center">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-center">{{ $user->role->role }}</td>
                                        <td class="px-6 py-4 text-center">{{ $user->status->status }}</td>
                                        <td class="px-6 py-4 text-center">{{ $user->deleted_at }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <button wire:click.="restore({{ $user->id }})"
                                                class="text-[#6ED82B] bg-white border-2 border-[#6ED82B] focus:ring-1 focus:outline-none focus:ring-[#6ED82B] 
                                                font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center me-2 hover:text-[#66C32A]
                                                hover:border-[#66C32A] hover:focus:ring-[#66C32A]">
                                                <x-phosphor-arrow-u-down-left-light class="flex-shrink-0 w-5 h-5" />
                                            </button>
                                            <button wire:click.prevent="forceDelete({{ $user->id }})"
                                                data-modal-toggle="forceDelete" data-modal-target="forceDelete"
                                                class="bg-white border-2 border-red-700 focus:ring-2 focus:outline-none 
                                                focus:ring-red-700 hover:border-red-800 font-semibold rounded-lg text-sm px-3 py-2 text-center 
                                                inline-flex items-center me-2">
                                                <x-phosphor-x-square-light
                                                    class="flex-shrink-0 w-5 h-5 text-red-700 transition duration-75" />
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- Tabla para usuarios eliminados - Móvil --}}
                    <div class="block sm:hidden">
                        <table class="w-full flex wrap rounded-lg md:hidden">
                            <thead class="space-y-4">
                                @foreach ($users as $user)
                                    <tr class="bg-[#1B3D73] text-[#FDC700] flex flex-col wrap sm:table-row">
                                        <th class="h-16 p-3 text-center content-center">Name</th>
                                        <th class="h-16 p-3 text-center content-center">Email</th>
                                        <th class="h-16 p-3 text-center content-center">Role</th>
                                        <th class="h-16 p-3 text-center content-center">Status</th>
                                        <th class="h-16 p-3 text-center content-center">Deleted at</th>
                                        <th class="h-16 p-3 text-center content-center">Actions</th>
                                    </tr>
                                @endforeach
                            </thead>
                            <tbody class="space-y-4 w-full">
                                @foreach ($users as $user)
                                    <tr class="flex flex-col wrap rounded-l-lg mb-4">
                                        <td
                                            class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                            {{ $user->name }}</td>
                                        <td
                                            class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                            {{ $user->email }}</td>
                                        <td
                                            class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                            {{ $user->role->role }}</td>
                                        <td
                                            class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                            {{ $user->status->status }}</td>
                                        <td
                                            class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                            {{ $user->deleted_at }}</td>
                                        <td
                                            class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                            <button wire:click.="setId({{ $user->id }})"
                                                class="text-[#6ED82B] bg-white border-2 border-[#6ED82B] focus:ring-1 focus:outline-none focus:ring-[#6ED82B] 
                                                font-medium rounded-lg text-sm px-3 py-2 text-center inline-flex items-center me-2 hover:text-[#66C32A]
                                                hover:border-[#66C32A] hover:focus:ring-[#66C32A]">
                                                <x-phosphor-arrow-u-down-left-light class="flex-shrink-0 w-5 h-5" />
                                            </button>
                                            <button wire:click.prevent="setId({{ $user->id }})"
                                                data-modal-toggle="forceDelete" data-modal-target="forceDelete"
                                                class="bg-white border-2 border-red-700 focus:ring-2 focus:outline-none 
                                                focus:ring-red-700 hover:border-red-800 font-semibold rounded-lg text-sm px-3 py-2 text-center 
                                                inline-flex items-center me-2">
                                                <x-phosphor-x-square-light
                                                    class="flex-shrink-0 w-5 h-5 text-red-700 transition duration-75" />
                                            </button>

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    {{-- Tabla para usuarios activos --}}
                    <div class="hidden md:block">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-[#FDC700] uppercase bg-[#1B3D73]">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-center">Name</th>
                                    <th scope="col" class="px-4 py-3 text-center">Email</th>
                                    <th scope="col" class="px-4 py-3 text-center">Role</th>
                                    <th scope="col" class="px-4 py-3 text-center">Status</th>
                                    <th scope="col" class="px-4 py-3 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td class="px-6 py-4 text-center">{{ $user->name }}</td>
                                        <td class="px-6 py-4 text-center">{{ $user->email }}</td>
                                        <td class="px-6 py-4 text-center">{{ $user->role->role }}</td>
                                        <td class="px-6 py-4 text-center">{{ $user->status->status }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <x-buttons.edit :route="route('users.edit', $user->id)" />
                                            <x-buttons.delete :id="$user->id" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{-- Tabla para usuarios activos - Móvil --}}
                    <div class="block sm:hidden">
                        <table class="w-full flex wrap rounded-lg md:hidden">
                            <thead class="space-y-4">
                                @foreach ($users as $user)
                                    <tr class="bg-[#1B3D73] text-[#FDC700] flex flex-col wrap sm:table-row">
                                        <th class="h-16 p-3 text-center content-center">Name</th>
                                        <th class="h-16 p-3 text-center content-center">Email</th>
                                        <th class="h-16 p-3 text-center content-center">Role</th>
                                        <th class="h-16 p-3 text-center content-center">Status</th>
                                        <th class="h-16 p-3 text-center content-center">Actions</th>
                                    </tr>
                                @endforeach
                            </thead>
                            <tbody class="space-y-4 w-full">
                                @foreach ($users as $user)
                                    <tr class="flex flex-col wrap rounded-l-lg mb-4">
                                        <td
                                            class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                            {{ $user->name }}</td>
                                        <td
                                            class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                            {{ $user->email }}</td>
                                        <td
                                            class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                            {{ $user->role->role }}</td>
                                        <td
                                            class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                            {{ $user->status->status }}</td>
                                        <td
                                            class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                            <x-buttons.edit :route="route('users.edit', $user->id)" />
                                            <x-buttons.delete :id="$user->id" />
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

    {{-- * Modal borrar usuario * --}}
    <div wire:ignore.self id="delete" data-modal-target="delete"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="delete">
                    <x-phosphor-x-light class="w-5 h-5" />
                    <span class="sr-only">Modal cerrar</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <x-phosphor-warning-circle-light class="mx-auto mb-4 text-gray-400 w-16 h-16" />
                    <h3 class="mb-5 text-lg font-normal text-gray-500">
                        Are you sure you want to delete the user {{ $selected_user->name ?? '' }}?
                    </h3>
                    <button wire:click="delete()" data-modal-hide="delete"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes
                    </button>
                    <button data-modal-hide="delete" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>

    {{-- * Modal eliminar definitivamente usuario * --}}
    <div id="forceDelete" data-modal-target="forceDelete"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="forceDelete">
                    <x-phosphor-x-light class="w-5 h-5" />
                    <span class="sr-only">Modal cerrar</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <x-phosphor-warning-circle-light class="mx-auto mb-4 text-gray-400 w-16 h-16" />
                    <h3 class="mb-5 text-lg font-normal text-gray-500">
                        Are you sure you want to delete permanently the user {{ $selected_user->name ?? '' }}?
                    </h3>
                    <button wire:click="forceDelete()" data-modal-hide="forceDelete"
                        class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Yes
                    </button>
                    <button data-modal-hide="forceDelete" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>
</div>
