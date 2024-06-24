<!DOCTYPE html>
<html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? 'Page Title' }}</title>

    {{-- Icons --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="{{ asset('assets/admin/css/mdb.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/css/new-prism.css') }}" />
    <link rel="icon" type="image/png" href="{{ asset('assets/admin/images/munagasatcom-logo.png') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/style.css') }}">

    @livewireStyles()
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />

    <style>
        .login-form {
            padding-top: 37px;
            max-width: 400px;
            margin: auto;
            margin-bottom: 50px;
        }

        .color-login-form {
            color: #315d90;
        }

        .bg-color-login-form {
            background-color: #315d90;
        }

        .nav-pills .nav-link.active {
            background-color: #315d90;
        }
    </style>

</head>

<body>

    @include('partials.web.navbar')
    {{ $slot }}
    @include('partials.web.footer')




    <script type="text/javascript" src="{{ asset('assets/admin/js/new-prism.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/mdb.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/jquery-3.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/admin/js/popper.min.js') }}"></script>
    @livewireScripts()
    @stack('web-login-script')
    @stack('web-register-script')
</body>

</html>
