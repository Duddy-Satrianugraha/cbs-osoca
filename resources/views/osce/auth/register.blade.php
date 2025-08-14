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
            <div class="info-title">Info Station</div>
            <p><span class="info-label">Ujian:</span> {{$ujian->name}}</p>
            <p><span class="info-label">Sesi Ujian:</span> {{$sesi->name}}</p>
            <p><span class="info-label">Tanggal:</span> {{tgl_indo($sesi->tgl_ujian)}}</p>
            <p><span class="info-label">Lokasi:</span>  {{$lokasi->nama}}</p>
            <p><span class="info-label">Station:</span>  {{$station->name}} - {{$template->judul_station}}</p>
            @php $rotasi =  $lokasi->rotations()->count();
                 $peserta =  $rotasi * $sesi->jml_station;
                @endphp
            <p><span class="info-label">Jumlah Rotasi:</span> {{$rotasi}} Rotasi</p>
            <p><span class="info-label">Total Peserta:</span> {{$peserta}} Peserta</p>
            <br><br><br><br><br>
            <a href="{{ route('osce.logout')}}" class="btn btn-bahaya">KELUAR</a>
        </div>

        <!-- Kanan: Panel Tab -->
        <!-- Panel Tab -->
        <div class="col-sm-6 tabs">
            <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#scan" role="tab" data-toggle="tab">SCAN QRCODE</a></li>
            <li><a href="{{ route('osce.penunjang')}}" role="tab" >PENUNJANG</a></li>
            </ul>
            <div class="tab-content">
            <div class="tab-pane fade in active" id="scan">
                <div class="info-title">Silahkan Arahkan Qr Code Penguji</div>
                <div class="card" style="width: 100%; max-width: 500px; height: 300px; margin: 0 auto; margin-bottom: 20px; padding: 4px;">
                    <video id="preview" style="width: 100%; height: 100%; object-fit: cover;"></video>
                </div>
            </div>
            <form action="{{ route('osce.penguji') }}" method="post" class="form-horizontal" id="form-scan">
                @csrf
                <input type="hidden" name="penguji_slug" id="soal-slug" value="">
            </form>
            </div>
        </div>

        <!--  akhri panel yab-->
      </div>
    </div>
  </div>


@endsection


@section('script')
<script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/osce_login.js') }}"></script>
@endsection
