@extends('layouts.admin.app')
@section('title', 'Edit contract type')
@section('content')

    <div class="w-full h-full flex flex-col">
        <x-breadcrumbs.contracts.edit :contract_type="$contract_type" />
        <div class="p-4 border-2 border-[#1B3D73] border rounded-lg flex flex-col h-full">
            <x-headers.header text="Edit Contract type" />
            {!! Form::open([
                'route' => ['contract_types.update', $contract_type->id],
                'method' => 'PUT',
                'class' => 'flex flex-col flex-grow w-full h-full',
            ]) !!}
            <div class="flex-grow">
                <div class="mb-6 w-full">
                    <x-inputs.texts.edit text="Name" type="text" name="name" required="required" :value="$contract_type->name" />
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
                        'value' => $contract_type->getUsersData('id'),
                    ])
                </div>
            </div>
            <div class="flex justify-between mt-4">
                <x-buttons.back :route="route('contract_types.index')" />
                <x-buttons.submit />
            </div>
            {!! Form::close() !!}
        </div>
    </div>

@endsection
