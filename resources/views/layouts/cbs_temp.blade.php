<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="UTF-8">
    <title>{{ config('app.name', 'CBS-OSOCA') }}</title>

    <link rel="stylesheet" type="text/css"  href="{{ asset('css/bootstrap/bootstrap.min.css')}}"/>
  <!-- Font Awesome 4.1.0 -->
  <link rel="stylesheet" type="text/css"  href="{{ asset('css/fontawesome/font-awesome.min.css')}}"/>
  <link rel="stylesheet" type="text/css"  href="{{ asset('css/osin.css')}}"/>
  @yield('css')
</head>
<body>

<!-- HEADER -->
<div class="top-bar">
    <div class="row">
        <div class="col-xs-4"><div class="pull-left">
            <img src="{{asset('img/logo.png')}}" alt="Logo OSCE" style="max-width: 40px;">
        </div></div>
        @yield('judul')
        <div class="col-xs-4 text-right">
            <div class="dropdown">
                @yield('penguji')
                
            </div>
        </div>
    </div>
</div>

<!-- MAIN CONTENT -->
<div class="container-fluid" style="margin-top: 20px;">
    @include('includes.osin_alert')
    <!-- DETAIL SOAL -->
    @yield('detail-soal')
</div>

<!-- Modal Penilaian -->
@yield('modal')



<!-- JS -->
<script type="text/javascript" src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap.min.js') }}"></script>
@yield('script')
</body>
</html>
