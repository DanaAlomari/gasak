<!DOCTYPE html>
{{-- <html lang="ar" dir='rtl'> --}}
<html lang="en" dir='ltr'>

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description"
        content="Sleek Dashboard - Free Bootstrap 4 Admin Dashboard Template and UI Kit. It is very powerful bootstrap admin dashboard, which allows you to build products like admin panels, content management systems and CRMs etc.">
    {{-- <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> --}}

        <meta property="og:title" content="gas"/>
        <meta property="og:type" content="website" />
        <meta property="og:image:type" content="image/png">
        <meta property="og:image:width" content="300">
        <meta property="og:image:height" content="300">
        {{-- <meta property="og:description" content="Your description."/>   --}}

    <title>Admin Dashboard</title>

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500"
        rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <!-- PLUGINS CSS STYLE -->
    <link href="{{ asset('dashboard_files/assets/plugins/nprogress/nprogress.css') }}" rel="stylesheet" />

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    {{-- Button CSS --}}



    <!-- SLEEK CSS LTR (EN): -->
    <link id="sleek-css" rel="stylesheet" href="{{ asset('dashboard_files/assets/css/sleek.css') }}" />

    <!-- SLEEK CSS RTL (AR) : -->
    {{-- <link id="sleek-css" rel="stylesheet" href="{{ asset('dashboard_files/assets/css/sleek.rtl.css') }}" /> --}}

    {{--  --}}
    <link href="{{ asset('dashboard_files/assets/plugins/data-tables/datatables.bootstrap4.min.css') }}"
        rel="stylesheet">

    <!-- FAVICON -->
    <link href="{{ asset('dashboard_files/assets/img/favicon.png') }}" rel="shortcut icon" />

    {{-- Sweet Alert --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"
        integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA=="
        crossorigin="anonymous"></script>

    <script src="{{ asset('dashboard_files/assets/plugins/nprogress/nprogress.js') }}"></script>
    <!-- L.A.L Custom : -->


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css"
        integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">

        <meta name="csrf-token" content="{{ csrf_token() }}" />

    @yield('admin_css')


        {{-- ========================================================== --}}
    {{-- =============== Live Select Search Section =============== --}}
    {{-- ========================================================== --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    {{-- ========================================================== --}}
    {{-- =============== Live Select Search Section =============== --}}
    {{-- ========================================================== --}}

</head>

<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">
    <script>
        NProgress.configure({
            showSpinner: false
        });
        NProgress.start();
    </script>
    <div id="toaster"></div>
    <div class="wrapper">
        <!-- Github Link -->
        <a href="https://github.com/tafcoder/sleek-dashboard" target="_blank" class="github-link">
            <svg width="70" height="70" viewBox="0 0 250 250" aria-hidden="true">
                <defs>
                    <linearGradient id="grad1" x1="0%" y1="75%" x2="100%" y2="0%">
                        <stop offset="0%" style="stop-color:#896def;stop-opacity:1" />
                        <stop offset="100%" style="stop-color:#482271;stop-opacity:1" />
                    </linearGradient>
                </defs>
                <path d="M 0,0 L115,115 L115,115 L142,142 L250,250 L250,0 Z" fill="url(#grad1)"></path>
            </svg>
            <i class="mdi mdi-github-circle"></i>
        </a>
