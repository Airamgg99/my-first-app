@extends('layouts.admin.app')
@section('title', 'Crear Usuario')
@section('content')

    <div class="w-full h-full flex flex-col">
        <x-breadcrumbs.users />
        <div class="p-4 border-2 border-[#1B3D73] border rounded-lg h-full flex flex-col">
            <x-headers.header text="Add User" />
            {!! Form::open([
                'route' => 'users.store',
                'method' => 'POST',
                'enctype' => 'multipart/form-data',
                'class' => 'flex flex-col flex-grow w-full h-full',
            ]) !!}
            <div class="flex-grow">
                <div class="mb-6 w-full">
                    <x-inputs.texts.create text="Name" type="text" name="name" required="required" />
                </div>
                <div class="mb-6 w-full">
                    <x-inputs.texts.create text="Email" type="email" name="email" required="required" />
                </div>
                <div class="mb-6 w-full">
                    <x-inputs.texts.create text="Password" type="password" name="password" required="false" />
                </div>
                <div class="mb-6">
                    @include('components.inputs.selectize.create', [
                        'id' => 'role',
                        'text' => 'Select a rol',
                        'name' => 'role_id',
                        'option' => 'role',
                        'option_id' => 'id',
                        'required' => true,
                        'elements' => App\Models\Roles\Role::orderBy('role')->get(),
                    ])
                </div>
                <div class="mb-6">
                    @include('components.inputs.selectize.create', [
                        'id' => 'status',
                        'text' => 'Select a status',
                        'name' => 'status_id',
                        'option' => 'status',
                        'option_id' => 'id',
                        'required' => true,
                        'elements' => App\Models\Statuses\Status::orderBy('status')->get(),
                    ])
                </div>
                <div class="mb-6">
                    <label class="block mb-2 text-sm font-medium text-gray-900" for="image-input">Subir
                        archivo</label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50"
                        id="image-input" type="file" name="image" accept="image/png, image/jpeg, image/jpg">
                </div>
            </div>
            <div class="flex justify-between mt-auto">
                <x-buttons.back :route="route('users.index')" />
                <x-buttons.submit />
            </div>
        </div>
        {!! Form::close() !!}
    </div>

@endsection
