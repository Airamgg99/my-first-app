<div>
    <div>
        <x-breadcrumbs.jobs.index />
        <div class="sm:rounded-lg relative overflow-hidden">
            <div class="flex flex-col sm:flex-row align-center justify-between space-y-3 sm:space-y-0 sm:space-x-3 pb-3">
                <div class="justify-start">
                    <x-buttons.add :route="route('jobs.create')" text="Add job" />
                    <x-buttons.download />
                </div>
                <x-inputs.search search="Job search" />
            </div>

            <div class="overflow-x-auto">
                {{-- Tabla responsive pantallas medias y grandes --}}
                <div class="w-full hidden md:block">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-[#FDC700] uppercase bg-[#1B3D73]">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3 text-center">
                                    Workers
                                </th>
                                <th scope="col" class="px-6 py-3 mr-3 flex justify-center">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobs as $job)
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 text-center">
                                        {{ $job->name }}
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @foreach ($job->users as $user)
                                            <x-badges.tooltip :id="'user_' . $user->id" :badgeText="$user->name" :tooltipText="$user->email"
                                                trigger="hover" />
                                        @endforeach
                                    </td>
                                    <td class="px-6 py-4 flex justify-center">
                                        <x-buttons.edit :route="route('jobs.edit', $job->id)" />
                                        <x-buttons.delete :id="$job->id" />
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- Tabla responsive móvil --}}
            <div class="block sm:hidden">
                <table class="w-full flex  wrap rounded-lg md:hidden">
                    <thead class="space-y-4">
                        @foreach ($jobs as $job)
                            <tr class="bg-blue-200 flex flex-col wrap sm:table-row rounded-l-lg sm:rounded mb-4">
                                <th class="h-16 p-3 text-center">Name</th>
                                <th class="h-16 p-3 text-center">Workers</th>
                                <th class="h-16 p-3 text-center">Actions</th>
                            </tr>
                        @endforeach
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr class="flex flex-col wrap rounded-l-lg mb-4">
                                <td class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center">
                                    {{ $job->name }}
                                </td>
                                <td
                                    class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                    @foreach ($job->users as $user)
                                        <x-badges.tooltip :id="'user_' . $user->id" :badgeText="$user->name" :tooltipText="$user->email"
                                            trigger="hover" />
                                    @endforeach
                                </td>
                                <td class="border-grey-light border hover:bg-gray-100 h-16 p-3 flex justify-center">
                                    <x-buttons.edit :route="route('jobs.edit', $job->id)" />
                                    <x-buttons.delete :id="$job->id" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- * Modal delete Job * --}}
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
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">
                        Are you sure you want to delete the job {{ $selected_job->name ?? '' }}?
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
</div>
