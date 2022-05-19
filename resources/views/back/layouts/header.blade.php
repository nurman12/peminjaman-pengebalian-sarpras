<!doctype html>
<html class="fixed">

<head>

    <!-- Basic -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>@stack('title')</title>
    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="JSOFT Admin - Responsive HTML5 Template">
    <meta name="author" content="JSOFT.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('/back') }}/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="{{ asset('/back') }}/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="{{ asset('/back') }}/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="{{ asset('/back') }}/vendor/bootstrap-datepicker/css/datepicker3.css" />

    <!-- Spesifik vendor  -->
    @if(Auth::user()->roles == 'BMN')
    <link rel="stylesheet" href="{{ asset('/back') }}/vendor/sweetalert/animate.min.css" />
    <link rel="stylesheet" href="{{ asset('/back') }}/vendor/sweetalert/sweetalert2.min.css" />
    @endif

    @stack('style')
    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('/back') }}/stylesheets/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{ asset('/back') }}/stylesheets/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/back') }}/stylesheets/theme-custom.css">

    <!-- Head Libs -->
    <script src="{{ asset('/back') }}/vendor/modernizr/modernizr.js"></script>

</head>