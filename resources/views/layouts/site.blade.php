<!DOCTYPE html>
<html lang="en" class="body-full-height">
    <head>
        <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'ugj') }}</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />
        <!-- END META SECTION -->

        <!-- CSS INCLUDE -->
        <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('css/theme-default.css') }}"/>
        <!-- EOF CSS INCLUDE -->
        @yield('css')
    </head>
    <body>

        <div class="login-container lightmode">
            <div class="login-box animated fadeInDown">
                <div class="login-logo"></div>
                <div class="login-body">
                    @include('includes.alert')
            @yield('content')
        </div>
        <div class="login-footer">
            <div class="pull-left">
                &copy; 2026 OSIN
            </div>
            <div class="pull-right">
                @yield('links')

                <a href="#">FK UGJ</a>
            </div>
        </div>
    </div>
        </div>

        <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/jquery/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/plugins/bootstrap/bootstrap.min.js')}}"></script>
@yield('javascript')
    </body>
</html>






