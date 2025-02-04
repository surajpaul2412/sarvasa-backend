<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="">
    <meta name="author" content="TheHonestCo">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('lib/remixicon/fonts/remixicon.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.min.css') }}">
</head>
<body class="page-sign">
    @yield('content')

    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        'use script'
        var skinMode = localStorage.getItem('skin-mode');
        if (skinMode) {
            $('html').attr('data-skin', 'dark');
        }
    </script>
</body>
</html>
