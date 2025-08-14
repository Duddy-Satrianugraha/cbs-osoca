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
          <div class="info-title">Login Station</div>
           <div class='col-sm-10'><br><br><br>
            <h4>Selesaikan Captcha Berikut</h4>
          <form action="{{ route('osce.scan') }}" method="post" class="form-horizontal" id="form-scan">
            @csrf

        <!-- CAPTCHA -->
            <div class="form-group">
                <label for="captcha" style="background-color: rgb(0, 19, 146); color: rgb(255, 255, 255); padding: 8px 12px; border-radius: 4px; display: inline-block;">
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
<script type="text/javascript" src="{{ asset('js/osce_login.js') }}"></script>

@endsection
