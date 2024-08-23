@extends('layouts.admin.app')
@section('title', 'Workplaces')
@section('content')

    <div class="sm:rounded-lg w-full">
        @livewire('workplaces.table')
    </div>

@endsection
