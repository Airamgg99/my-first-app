@extends('layouts.admin.app')
@section('title', 'Jobs')
@section('content')

    <div class="sm:rounded-lg w-full">
        @livewire('jobs.table')
    </div>

@endsection
