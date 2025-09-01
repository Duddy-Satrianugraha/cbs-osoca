@extends('layouts.site')

@section('css')

@endsection

@section('content')

        <div class="login-title" style="color: #450163;"><strong style="color: white;">Feedback</strong> Mahasiswa</div>
            <h4> Isi Chaptcha dan arahkan Qrcode Peserta untuk mendownlaod feedback</h4>
          
        <div class="form-group @error('username') has-error @enderror">
            <div class="col-md-12" style="width: 100%;  margin: 0 auto; margin-bottom: 20px; padding: 4px;">
               <video id="preview" style="width: 100%; height: 100%; object-fit: cover;"></video>
            </div>
        </div>
        
        <form action="{{ route('feedback.chek') }}" class="form-horizontal" id="formscan" method="post"> 
             @csrf
             <input type="hidden" name="soal_slug" id="soal-slug"  value="">
        <div class="form-group @error('captcha') has-error @enderror">
            <div class="col-md-12">
                <label for="captcha" style="background-color: rgb(202, 111, 0); color: rgb(255, 255, 255); padding: 8px 12px; border-radius: 4px; display: inline-block;">
                    {{ generate_captcha() }}</label>
                <input type="text" name="captcha" class="form-control" placeholder="jawaban captcha, angka saja"  autocomplete="off" required/>
                <input type="hidden" name="code" value="5e25c197ae1f74a267a7737c8d89e6d1"/>
            </div>
        </div>
        </form>

        <div class="form-group">
            <div class="col-md-6">
                
            </div>
            <div class="col-md-6">
              
            </div>
        </div>

        

@endsection

@section('links')
<a href="{{ route('penguji.login')}}">CBS-OSOCA</a> |
@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/feed_login.js') }}"></script>
@endsection

