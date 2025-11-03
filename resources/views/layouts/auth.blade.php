<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="BootstrapDash">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'SignIn | iClear' }}</title>

    <!-- vendor css -->
    <link href="{{ asset('lib/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/typicons.font/typicons.css') }}" rel="stylesheet">

    <!-- azia CSS -->
    <link rel="stylesheet" href="{{ asset('css/azia.css') }}">

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
</head>

<body class="az-body">

    <div class="az-signin-wrapper">
        {{ $slot }}
    </div><!-- az-signin-wrapper -->

    <script src="{{ asset('lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('lib/ionicons/ionicons.js') }}"></script>
    <script src="{{ asset('js/jquery.cookie.js') }}" type="text/javascript"></script>

    <script src="{{ asset('js/azia.js') }}"></script>
    <script>
        $(function() {
            'use strict'
        });
    </script>
</body>

</html>
