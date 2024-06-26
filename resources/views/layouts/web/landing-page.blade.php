<!doctype html>
<html lang="ar" dir="rtl">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="description" content="المسبح الأولومبي الجامعة الإسلامية">
    <meta name="keywords" content="مسبح, اولومبي, الجامعة الاسلامية ">
    <meta name="author" content="الجامعة الاسلامية">

    <link rel="stylesheet" href="{{ asset('assets/web/css/bootstrap.rtl.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/fonts/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/boxicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/nice-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/theme-dark.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/web/css/rtl.css') }}">
    <title>{{ $settings?->website_name ?? 'ضع الاسم من لوحة التحكم' }}</title>
    <link rel="icon" type="image/png" href="assets/img/favicon.png">

    @livewireStyles()
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts />
</head>

<body>

    <div class="preloader">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="spinner">
                    <div class="circle1"></div>
                    <div class="circle2"></div>
                    <div class="circle3"></div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.web.header')
    @include('partials.web.top-bar')
    @yield('content')
    @include('partials.web.footer')


    <script data-cfasync="false" src="../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>

    @livewireScripts()
    <script src=" {{ asset('assets/web/js/jquery.min.js') }} "></script>
    <script src="{{ asset('assets/web/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('assets/web/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/meanmenu.js') }}"></script>
    <script src="{{ asset('assets/web/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/jquery.ajaxchimp.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/form-validator.min.js') }}"></script>
    <script src="{{ asset('assets/web/js/contact-form-script.js') }}"></script>
    <script src="{{ asset('assets/web/js/custom.js') }}"></script>



    @stack('contact-us-script-js')




</body>

</html>
