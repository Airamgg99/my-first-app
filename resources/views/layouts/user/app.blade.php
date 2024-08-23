<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="Content-Language" content="es" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- JQUERY -->
    <script src="/js/jquery.min.js"></script>

    <!-- TAILWIND CSS -->
    <script src="/js/tailwind_typo.js"></script>

    <!-- FLOWBITE -->
    <script src="/js/flowbite.min.js"></script>
    <link href="/css/flowbite.min.css" rel="stylesheet" />

    <!-- SELECTIZE -->
    <script src="/js/selectize.min.js"></script>
    <link rel="stylesheet" href="/css/selectize.min.css">

    <!-- SWEETALERT -->
    <script src="/vendor/sweetalert/sweetalert.all.js"></script>

    <!-- SwEETALERT2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- FULLCALENDAR -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.12/index.global.min.js"></script>

    <!-- BOOTSRAP -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    @livewireStyles
</head>

<body class="h-screen flex flex-col">
    @include('sweetalert::alert')

    @include('layouts.user.navbar')

    <div class="md:p-5 p-4 mt-16 flex-grow flex md:ml-64">
        @yield('content')
    </div>
    @livewireScripts

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <x-livewire-alert::scripts />
</body>

</html>
