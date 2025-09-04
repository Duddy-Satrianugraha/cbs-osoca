@extends('layouts.cbs_login')

@section('css')

@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1 card shadow-card">
        @include('includes.osin_alert')
      <div class="row">
        <!-- Kiri: Info Station -->
        <div class="col-sm-6">
          <div class="info-title">Login Station Peserta OSOCA</div>
           <div class='col-sm-10' style="text-align: center"><br><br><br>
            <h2>{{ $station->name }} </h2>
            <h4>Sesi {{ $station->current }} </h4>
            <h6>Soal akan tampil selama 10 Menit</h6>

          <form action="{{ route('peserta.sscan')}}" method="post" class="form-horizontal" id="form-scan">
            @csrf
            <!-- hidden station_slug -->
            <input type="hidden" name="soal_slug" id="soal-slug"  value="">
            </form>

           </div>
        </div>

        <!-- Kanan: Panel Tab -->
        <!-- Panel Tab -->
            <div class="col-sm-6">
                <div class="info-title">Silahkan Arahkan Qr Code Peserta</div>
                <div class="card" style="width: 100%; max-width: 500px; height: 300px; margin: 0 auto; margin-bottom: 20px; padding: 4px;">
                    <video id="preview" style="width: 100%; height: 100%; object-fit: cover;"></video>
                </div>
                <a href="{{ route('peserta.logout')}}" class="pull-right" style="text-decoration: none; color:black; hover:black"> <small>2025 FK UGJ</small></a>
            </div>


        <!--  akhri panel yab-->
      </div>
    </div>
  </div>


@endsection


@section('script')
<script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/osoca_login.js') }}"></script>

@endsection
