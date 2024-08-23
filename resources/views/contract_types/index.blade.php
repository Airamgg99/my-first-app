@extends('layouts.admin.app')
@section('title', 'Contract types')
@section('content')

    <div class="sm:rounded-lg w-full">
        @livewire('contract-types.table')
    </div>

@endsection
