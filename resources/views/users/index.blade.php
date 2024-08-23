@extends('layouts.admin.app')
@section('title', 'Users')
@section('content')

    <div class="sm:rounded-lg w-full">
        @livewire('users.table')
    </div>

@endsection
