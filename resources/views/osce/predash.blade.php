@extends('layouts.osce')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb push-down-0">
    <li>{{$ujian->name}}</li>
    <li>{{$sesi->name}}</li>
    <li>{{$lokasi->nama}}</li>
    <li class="active">{{$station->name}}</li>
</ul>
<!-- END BREADCRUMB -->
@endsection

@section('page-title')

@endsection

@section('content')
<div class="page-title">
    <h2>Penguji Scan</h2>
</div>

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">

    <div class="row">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-body" style="text-align: center;">
                   <h1> {{$ujian->name}}</h1>
                    <h2> {{$sesi->name}}</h2>
                    <h3> {{$lokasi->nama}}</h3>
                    <h4> {{$station->name}}</h4>
                    <a href="{{ route('osce.penunjang')}}" class="btn btn-primary btn-sm">Pemeriksaan Penunjang mahasiswa</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="card" style="width: 100%; max-width: 500px; height: 300px; margin: 0 auto; margin-bottom: 20px;">
                        <video id="preview" style="width: 100%; height: 100%; object-fit: cover;"></video>
                    </div>

                    <form action="{{ route('osce.penguji') }}" method="post" class="form-horizontal" id="form-scan">
                        @csrf
                        <input type="hidden" name="penguji_slug" id="soal-slug" value="">

                        <div class="form-group">
                            <div class="col-md-12" style="text-align: center;">
                                silahkan scan Kartu Penguji OSCE
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- PAGE CONTENT WRAPPER -->
@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>
<script type="text/javascript">
    let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

    scanner.addListener('scan', function (content) {
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
        alert('error : ' + e);
    });
</script>
@endsection
