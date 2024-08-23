@extends('layouts.admin.app')
@section('title', 'Create contract type')
@section('content')

    <div class="w-full h-full flex flex-col">
        @include('components.breadcrumbs.contract_types')
        <div class="p-4 border-2 border-[#1B3D73] border rounded-lg flex flex-col h-full">
            @include('components.headers.header', ['text' => 'Add Contract type'])
            {!! Form::open([
                'route' => 'contract_types.store',
                'method' => 'POST',
                'class' => 'flex flex-col flex-grow w-full h-full',
            ]) !!}
            <div class="flex-grow">
                <div class="mb-6 w-full">
                    @include('components.inputs.texts.create', [
                        'text' => 'Name',
                        'type' => 'text',
                        'name' => 'name',
                        'required' => 'required',
                    ])
                </div>
                <div class="mb-6">
                    @include('components.inputs.selectize.multiple.create', [
                        'id' => 'user_id',
                        'text' => 'Workers',
                        'name' => 'user_ids[]',
                        'option' => 'name',
                        'option_id' => 'id',
                        'required' => false,
                        'elements' => App\Models\Users\User::orderBy('id')->get(),
                    ])
                </div>
            </div>
            <div class="flex justify-between mt-4">
                @include('components.buttons.back', [
                    'route' => route('contract_types.index'),
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
