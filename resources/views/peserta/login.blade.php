@extends('layouts.cbs_login')

@section('css')

@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1 card shadow-card " style="background-color: rgb(189, 168, 202);">
        @include('includes.osin_alert')
      <div class="row">
        <!-- Kiri: Info Station -->
        <div class="col-sm-6">
          <div class="info-title">Login Station OSOCA</div>
           <div class='col-sm-10'><br><br><br>

          <form action="{{ route('peserta.scan')}}" method="post" class="form-horizontal" id="form-scan">
            @csrf
            <h4>Selesaikan Captcha Berikut</h4>
        <!-- CAPTCHA -->
            <div class="form-group">
                <label for="captcha" style="background-color: rgb(85, 4, 136); color: rgb(255, 255, 255); padding: 8px 12px; border-radius: 4px; display: inline-block;">
                    {{ generate_captcha() }}</label>
                    <br>
                <input type="text" name="captcha" id="captcha" class="form-control" placeholder="Jawaban CAPTCHA" >
            </div>

            <!-- hidden station_slug -->
            <input type="hidden" name="soal_slug" id="soal-slug"  value="">


            </form>
           </div>
        </div>

        <!-- Kanan: Panel Tab -->
        <!-- Panel Tab -->
            <div class="col-sm-6">
                <div class="info-title">Silahkan Arahkan Qr Code Station</div>
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
