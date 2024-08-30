<div class="flex flex-col h-full">
    <div class="w-full">
        <div class="flex flex-col sm:flex-row justify-start space-y-3 sm:space-y-0 sm:space-x-3 pb-3">
            <div class="flex space-x-3 items-center justify-between">
                <x-buttons.toggleTable toggle="toggleUnlinkedJobs" :showUnlinked="$showUnlinkedJob" />
            </div>
        </div>
        @if (!$showUnlinkedJob)
            <div class="flex flex-col sm:flex-row justify-end space-y-3 sm:space-y-0 sm:space-x-3 pb-3">
                <x-inputs.search search="Jobs search" />
            </div>
            {{-- * Tabla responsive pantallas medias y grandes * --}}
            <div class="hidden sm:block">
                <table class="w-full text-sm text-left">
                    <thead class="text-xs uppercase bg-[#1B3D73]">
                        <tr class="text-[#FDC700]">
                            <th scope="col" class="px-4 py-3 text-center">Name</th>
                            <th scope="col" class="px-4 py-3 mr-2 flex justify-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jobs as $job)
                            <tr class="bg-white border-b hover:bg-gray-50">
                                <td class="px-6 py-4 text-center">
                                    {{ $job->name }}
                                </td>
                                <td class="px-6 py-4 flex justify-center">
                                    <x-buttons.unlink :id="$job->id" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- * Tabla responsive móvil * --}}
            <div class="block sm:hidden">
                <table class="w-full flex wrap rounded-lg md:hidden">
                    <thead class="space-y-4">
                        @foreach ($jobs as $job)
                            <tr class="bg-[#1B3D73] text-[#FDC700] flex flex-col wrap sm:table-row">
                                <th class="h-16 p-3 text-center content-center">Name</th>
                                <th class="h-16 p-3 text-center content-center">Actions</th>
                            </tr>
                        @endforeach
                    </thead>
                    <tbody class="space-y-4 w-full">
                        @foreach ($jobs as $job)
                            <tr class="flex flex-col wrap rounded-l-lg mb-4">
                                <td
                                    class="border-grey-light border hover:bg-gray-100 h-16 p-3 text-center content-center">
                                    {{ $job->name }}
                                </td>
                                <td
                                    class="border-grey-light border hover:bg-gray-100 h-16 p-3 flex justify-center content-center">
                                    <x-buttons.unlink :id="$job->id" />
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            {{-- * Tabla para mostrar información no relacionada * --}}
            <div class="w-full">
                @livewire('users.show.jobs.unlinked-jobs', ['user' => $user])
            </div>
        @endif
    </div>

    {{-- * Paginación * --}}
    <div class="mt-4">
        {{ $jobs->links() }}
    </div>

    <div class="flex justify-between mt-auto pt-3">
        <x-buttons.back :route="route('users.index')" />
    </div>
</div>
