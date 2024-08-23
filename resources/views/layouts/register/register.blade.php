<!DOCTYPE html>
<html lang="en" class="h-full">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>

    <!-- TAILWIND CSS -->
    <script src="/js/tailwind_typo.js"></script>

    <!-- FLOWBITE -->
    <script src="/js/flowbite.min.js"></script>
    <link href="/css/flowbite.min.css" rel="stylesheet" />

    <!-- SWEETALERT -->
    <script src="/vendor/sweetalert/sweetalert.all.js"></script>

    <!-- JQUERY -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
</head>

<body class="h-full">
    @include('sweetalert::alert')
    @yield('content')
</body>

</html>
