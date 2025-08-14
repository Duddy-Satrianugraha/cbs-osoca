@extends('layouts.site')

@section('css')

@endsection

@section('content')

    <div class="login-title" style="color: #450163;">
        <strong style="color: white;">Station Ujian</strong> OSCE
    </div>

    <div class="card" style="width: 100%; max-width: 500px; height: 300px; margin: 0 auto; margin-bottom: 20px;">
        <video id="preview" style="width: 100%; height: 100%; object-fit: cover;"></video>
    </div>

    <form action="{{ route('osce.scan') }}" method="post" class="form-horizontal" id="form-scan">
        @csrf
        <input type="hidden" name="soal_slug" id="soal-slug" value="">

        <div class="form-group @error('captcha') has-error @enderror">
            <div class="col-md-12">
                <label for="captcha" style="background-color: rgb(202, 111, 0); color: rgb(255, 255, 255); padding: 8px 12px; border-radius: 4px; display: inline-block;">
                    {{ generate_captcha() }}</label>
                <input type="text" name="captcha" class="form-control" placeholder="jawaban captcha, angka saja" required/>
                <input type="hidden" name="code" value="5e25c197ae1f74a267a7737c8d89e6d1"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-12">
                silahkan Isi CAPTCHA dulu baru scan Kartu Station OSCE
            </div>
        </div>
    </form>

@endsection

@section('links')
<a href="{{ route('penguji.login')}}">Penguji</a> |
@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>
<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

    scanner.addListener('scan', function (content) {
        console.log('QR scanned:', content);
        document.getElementById('soal-slug').value = content;
        document.getElementById('form-scan').submit();
    });

    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            alert('Kamera tidak ditemukan. Pastikan Anda memberikan izin akses kamera.');
        }
    }).catch(function (e) {
        console.error(e);
    });
</script>
@endsection
