<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <title>{{ config('app.name', 'Arap') }}</title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon" />
        <!-- END META SECTION -->

  <!-- Bootstrap 3.3.0 -->
  <link rel="stylesheet" type="text/css"  href="{{ asset('css/bootstrap/bootstrap.min.css')}}"/>
  <!-- Font Awesome 4.1.0 -->
  <link rel="stylesheet" type="text/css"  href="{{ asset('css/fontawesome/font-awesome.min.css')}}"/>
  <link rel="stylesheet" type="text/css"  href="{{ asset('css/login_osin.css')}}"/>


  <style>

  </style>
  @yield('css')
</head>
<body>

    <!-- Logo Tengah -->
    <div class="text-center" style="margin-top: 40px;">
        <img src="/img/logo.png" alt="Logo OSCE" style="max-width: 150px;">
    </div>

<div class="container">
 @yield('content')

</div>

<!-- JS -->
<script type="text/javascript" src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap.min.js') }}"></script>
@yield('script')
</body>
</html>
