<!DOCTYPE html>
<html lang="id">
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <title>{{ config('app.name', 'Arap') }}</title>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap/bootstrap.min.css') }}"/>
  <link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome/font-awesome.min.css') }}"/>
  <style>
    body { background-color: #f5f5f5; padding: 20px; }
    .top-bar { background-color: #fff; border-bottom: 1px solid #ddd; padding: 10px 20px; }
    .top-bar .logo { height: 40px; }
    .logout-btn { margin-top: 5px; }
    .center-title { font-size: 18px; font-weight: bold; text-align: center; line-height: 40px; }
    .panel-osce { border: 5px solid #66ff66; padding: 20px; background-color: white; margin-top: 30px; }
    .nav-tabs > li.active > a { background-color: #66ff66 !important; color: black; }
    textarea.form-control { resize: none; }
    .submit-btn { margin-top: 15px; float: right; }
    .checkbox-scrollable { max-height: 400px; overflow-y: auto; padding-right: 10px; }
    .checkbox-col { column-count: 3; }
    .checkbox-col label { display: block; }
  </style>
</head>
<body>
  <!-- HEADER -->
  <div class="top-bar clearfix">
    <div class="pull-left">
      <img src="/img/logo.png" alt="Logo Institusi" class="logo">
    </div>
    <div class="pull-left" style="width: 90%; text-align: center;">
      <h4 style="margin: 0; line-height: 40px; font-weight: bold;">OSCE {{ $ujian->name }}</h4>
    </div>
    <div class="pull-right" style="margin-top: 5px;">
      <a href="{{ route('osce.logout') }}" class="btn btn-danger btn-xs">
        <i class="fa fa-sign-out"></i> Logout
      </a>
    </div>
  </div>

  <!-- ISI -->
  <div class="container">
    <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#pemeriksaan">Pemeriksaan</a></li>
      <li><a data-toggle="tab" href="#diagnosis">Diagnosis</a></li>
      <li><a data-toggle="tab" href="#terapi">Terapi</a></li>
    </ul>

    <div class="tab-content panel-osce">
      <!-- Pemeriksaan Tab -->
      <div id="pemeriksaan" class="tab-pane fade in active">
        <p><strong>Pilih pemeriksaan penunjang yang Anda ajukan maksimal 5! (Ctrl+F untuk mencari)</strong></p>
        <div class="row checkbox-scrollable">
          <div class="col-md-12 checkbox-col">
            <strong>LABORATORIUM</strong>
            <label><input type="checkbox"> Darah rutin</label>
            <label><input type="checkbox"> Laju endap darah</label>
            <label><input type="checkbox"> Retikulosit</label>
            <strong>RADIOLOGI</strong>
            <label><input type="checkbox"> Foto Toraks AP/PA</label>
            <label><input type="checkbox"> Foto Toraks AP/Lat</label>
            <label><input type="checkbox"> USG</label>
            <strong>PENUNJANG LAIN</strong>
            <label><input type="checkbox"> EKG</label>
            <label><input type="checkbox"> Spirometri</label>
          </div>
        </div>
        <div class="clearfix">
          <button class="btn btn-info submit-btn">Kumpulkan</button>
        </div>
      </div>

      <!-- Diagnosis Tab -->
      <div id="diagnosis" class="tab-pane fade">
        <p><strong>Tuliskan diagnosis yang Anda tetapkan!</strong></p>
        <div class="form-group">
          <label>Diagnosis</label>
          <input type="text" class="form-control">
          <label>Diagnosis banding 1</label>
          <input type="text" class="form-control">
          <label>Diagnosis banding 2</label>
          <input type="text" class="form-control">
        </div>
        <div class="clearfix">
          <button class="btn btn-success submit-btn">Kumpulkan</button>
        </div>
      </div>

      <!-- Terapi Tab -->
      <div id="terapi" class="tab-pane fade">
        <p><strong>Tuliskan resep yang Anda berikan kepada pasien!</strong></p>
        <div class="form-group">
          <label>R/</label>
          <textarea class="form-control" rows="2"></textarea>
          <label>R/</label>
          <textarea class="form-control" rows="2"></textarea>
          <label>R/</label>
          <textarea class="form-control" rows="2"></textarea>
          <label>R/</label>
          <textarea class="form-control" rows="2"></textarea>
        </div>
        <div class="clearfix">
          <button class="btn btn-success submit-btn">Kumpulkan</button>
        </div>
      </div>
    </div>
  </div>

  <!-- JS -->
  <script type="text/javascript" src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap.min.js') }}"></script>
</body>
</html>
