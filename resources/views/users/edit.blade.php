@extends('layouts.admin.app')
@section('title', 'Editar Usuario')
@section('content')

    <div class="w-full h-full flex flex-col">
        <x-breadcrumbs.users.edit :user="$user" />

        <div class="border-2 border-[#1B3D73] h-full flex flex-col">
            <div class="border-b border-[#1B3D73] text-[#1B3D73]">
                @include('users.tabs')
            </div>
            <div class="h-full flex flex-col">
                <div id="default-tab-content" class="flex flex-grow">
                    <div class="hidden p-4 rounded-lg flex-grow" id="info" role="tabpanel" aria-labelledby="info-tab">
                        @include('users.tabs.info')
                    </div>
                    <div class="hidden p-4 rounded-lg flex-grow" id="workplaces" role="tabpanel"
                        aria-labelledby="workplaces-tab">
                        @livewire('users.show.workplaces.workplaces', ['user' => $user])
                    </div>
                    <div class="hidden p-4 rounded-lg flex-grow" id="jobs" role="tabpanel" aria-labelledby="jobs-tab">
                        @livewire('users.show.jobs.jobs', ['user' => $user])
                    </div>
                    <div class="hidden p-4 rounded-lg flex-grow" id="contract_types" role="tabpanel"
                        aria-labelledby="contract_types-tab">
                        @livewire('users.show.contract-types.contract-types', ['user' => $user])
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
