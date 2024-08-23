@extends('layouts.admin.app')
@section('title', 'Edit workplace')
@section('content')

    <div class="w-full h-full flex flex-col">
        @include('components.breadcrumbs.workplaces')
        <div class="p-4 border-2 border-[#1B3D73] border rounded-lg flex flex-col h-full">
            @include('components.headers.header', ['text' => 'Edit Workplace'])
            {!! Form::open([
                'route' => ['workplaces.update', $workplace->id],
                'method' => 'PUT',
                'class' => 'flex flex-col flex-grow w-full h-full',
            ]) !!}
            <div class="flex-grow">
                <div class="mb-6 w-full">
                    @include('components.inputs.texts.edit', [
                        'text' => 'Name',
                        'type' => 'text',
                        'name' => 'name',
                        'required' => 'required',
                        'value' => $workplace->name,
                    ])
                </div>
                <div class="mb-6 w-full">
                    @include('components.inputs.texts.edit', [
                        'text' => 'Address',
                        'type' => 'text',
                        'name' => 'address',
                        'required' => 'required',
                        'value' => $workplace->address,
                    ])
                </div>
                <div class="mb-6">
                    @include('components.inputs.selectize.multiple.edit', [
                        'id' => 'user_id',
                        'text' => 'Workers',
                        'name' => 'user_ids[]',
                        'option' => 'name',
                        'option_id' => 'id',
                        'required' => false,
                        'elements' => App\Models\Users\User::orderBy('id')->get(),
                        'value' => $workplace->getUsersData('id'),
                    ])
                </div>
            </div>
            <div class="flex justify-between mt-4">
                @include('components.buttons.back', [
                    'route' => route('workplaces.index'),
                    'text' => 'Back',
                ])
                @include('components.buttons.submit', [
                    'text' => 'Submit',
                ])
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
