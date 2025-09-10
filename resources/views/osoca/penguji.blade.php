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
          <div class="info-title">Login Penguji OSOCA</div>
           <div class='col-sm-10' style="text-align: center"><br>

          <form action="{{ route('osoca.penguji.chek')}}" method="post" class="form-horizontal" id="form-scan">
            @csrf

            <h2>{{ $data['ujian']->name }} </h2>
            <h3><strong>{{ $data['station']->name }} </strong> </h3>
            <!-- hidden station_slug -->
            <input type="hidden" name="soal_slug" id="soal-slug"  value="">


            </form>
           </div>
        </div>

        <!-- Kanan: Panel Tab -->
        <!-- Panel Tab -->
            <div class="col-sm-6">
                <div class="info-title">Silahkan Arahkan Qr Code Penguji</div>
                <div class="card" style="width: 100%; max-width: 500px; height: 300px; margin: 0 auto; margin-bottom: 20px; padding: 4px;">
                    <video id="preview" style="width: 100%; height: 100%; object-fit: cover;"></video>
                </div>

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
