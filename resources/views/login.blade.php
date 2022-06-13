<!doctype html>
<html class="fixed">

<head>
    <title>Login</title>
    <!-- Basic -->
    <meta charset="UTF-8">

    <meta name="keywords" content="HTML5 Admin Template" />
    <meta name="description" content="Porto Admin - Responsive HTML5 Template">
    <meta name="author" content="okler.net">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

    <!-- Web Fonts  -->
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('/back') }}/vendor/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="{{ asset('/back') }}/vendor/font-awesome/css/font-awesome.css" />
    <link rel="stylesheet" href="{{ asset('/back') }}/vendor/magnific-popup/magnific-popup.css" />
    <link rel="stylesheet" href="{{ asset('/back') }}/vendor/bootstrap-datepicker/css/datepicker3.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="{{ asset('/back') }}/stylesheets/theme.css" />

    <!-- Skin CSS -->
    <link rel="stylesheet" href="{{ asset('/back') }}/stylesheets/skins/default.css" />

    <!-- Theme Custom CSS -->
    <link rel="stylesheet" href="{{ asset('/back') }}/stylesheets/theme-custom.css">

    <!-- Head Libs -->
    <script src="{{ asset('/back') }}/vendor/modernizr/modernizr.js"></script>

</head>

<body>
    <!-- start: page -->
    <section class="body-sign">
        <div class="center-sign">
            <a href="/" class="logo pull-left">
                <img src="{{ asset('/front') }}/images/logo-polinema-sayap.png" height="54" alt="Porto Admin" />
            </a>

            <div class="panel panel-sign">
                <div class="panel-title-sign mt-xl text-right">
                    <h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
                </div>
                <div class="panel-body">
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <div class="form-group mb-lg">
                            <label for="nim_nidn">NIDN/NIP/NIM</label>
                            <div class="input-group input-group-icon">
                                <input id="nim_nidn" type="text" class="form-control input-lg @error('nim_nidn') is-invalid @enderror" name="nim_nidn" value="{{ old('nim_nidn') }}" autofocus />
                                <span class="input-group-addon">
                                    <span class="icon icon-lg">
                                        <i class="fa fa-credit-card"></i>
                                    </span>
                                </span>
                            </div>
                            @error('nim_nidn')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="form-group mb-lg">
                            <div class="clearfix">
                                <label class="pull-left" for="password">Password</label>
                                <a class="pull-right" href="{{ route('password.request') }}">
                                    Lupa Password
                                </a>
                            </div>
                            <div class="input-group input-group-icon">
                                <input id="password" type="password" class="form-control input-lg @error('password') is-invalid @enderror" name="password" autocomplete="current-password" />
                                <span class="input-group-addon">
                                    <span class="icon icon-lg">
                                        <i class="fa fa-lock"></i>
                                    </span>
                                </span>
                            </div>
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-sm-8">
                                <div class="checkbox-custom checkbox-default">
                                    <input type="checkbox" id="showPassword">

                                    <label for="showPassword">
                                        Show password
                                    </label>
                                </div>
                            </div>
                            <div class="col-sm-4 ">
                                <button type="submit" class="btn btn-primary hidden-xs">Sign In</button>
                                <button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <p class="text-center text-muted mt-md mb-md">&copy; Copyright 2018. All rights reserved. Template by <a href="https://colorlib.com">Colorlib</a>.</p>
        </div>
    </section>
    <!-- end: page -->

    <!-- Vendor -->
    <script src="{{ asset('/back') }}/vendor/jquery/jquery.js"></script>
    <script>
        const showPassword = document.getElementById('showPassword');
        const password = document.getElementById('password');

        showPassword.onclick = () => {
            if (password.type == "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }
        }
    </script>
    <script src="{{ asset('/back') }}/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
    <script src="{{ asset('/back') }}/vendor/bootstrap/js/bootstrap.js"></script>
    <script src="{{ asset('/back') }}/vendor/nanoscroller/nanoscroller.js"></script>
    <script src="{{ asset('/back') }}/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script src="{{ asset('/back') }}/vendor/magnific-popup/magnific-popup.js"></script>
    <script src="{{ asset('/back') }}/vendor/jquery-placeholder/jquery.placeholder.js"></script>
    <!-- Theme Base, Components and Settings -->
    <script src="{{ asset('/back') }}/javascripts/theme.js"></script>

    <!-- Theme Custom -->
    <script src="{{ asset('/back') }}/javascripts/theme.custom.js"></script>

    <!-- Theme Initialization Files -->
    <script src="{{ asset('/back') }}/javascripts/theme.init.js"></script>

</body>
<!-- <img src="http://www.ten28.com/fref.jpg"> -->

</html>