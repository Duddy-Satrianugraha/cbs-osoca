@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
        <li class="active">Dashboard</li>
</ul>
<!-- END BREADCRUMB -->
@endsection

@section('content')

<!-- START WIDGETS -->
<div class="row">
    <div class="col-md-3">

          <!-- START WIDGET SLIDER -->
          <div class="widget widget-default widget-carousel">
            <div class="owl-carousel" id="owl-example">
                <div>
                    <div class="widget-title">Jumlah</div>
                    <div class="widget-subtitle">Ujian</div>
                    <div class="widget-int">{{count($ujian)}}</div>
                </div>
                <div>
                    <div class="widget-title">Jumlah</div>
                    <div class="widget-subtitle">Sesi</div>
                    <div class="widget-int">{{count($sesi)}}</div>
                </div>
                <div>
                    <div class="widget-title">Jumlah</div>
                    <div class="widget-subtitle">Station</div>
                    <div class="widget-int">{{count($station)}}</div>
                </div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
        <!-- END WIDGET SLIDER -->

    </div>
    <div class="col-md-3">

        <!-- START WIDGET REGISTRED -->
        <div class="widget widget-default widget-item-icon" onclick="location.href='#';">
            <div class="widget-item-left">
                <span class="fa fa-user-md"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">{{count($penguji)}}</div>
                <div class="widget-title">penguji</div>
                <div class="widget-subtitle">terdaftar pada CBS-OSOCA</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
        <!-- END WIDGET REGISTRED -->
    </div>
    <div class="col-md-3">

        <!-- START WIDGET REGISTRED -->
        <div class="widget widget-default widget-item-icon" onclick="location.href='#';">
            <div class="widget-item-left">
                <span class="fa fa-user"></span>
            </div>
            <div class="widget-data">
                <div class="widget-int num-count">{{count($peserta)}}</div>
                <div class="widget-title">Mahasiswa</div>
                <div class="widget-subtitle">terdaftar pada CBS-OSOCA</div>
            </div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="top" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
        </div>
        <!-- END WIDGET REGISTRED -->

    </div>
    <div class="col-md-3">

        <!-- START WIDGET CLOCK -->
        <div class="widget widget-info widget-padding-sm">
            <div class="widget-big-int plugin-clock">00:00</div>
            <div class="widget-subtitle plugin-date">Loading...</div>
            <div class="widget-controls">
                <a href="#" class="widget-control-right widget-remove" data-toggle="tooltip" data-placement="left" title="Remove Widget"><span class="fa fa-times"></span></a>
            </div>
            <div class="widget-buttons widget-c3">
               {!! Illuminate\Foundation\Inspiring::quote() !!}
            </div>
        </div>
        <!-- END WIDGET CLOCK -->

    </div>
</div>
<!-- END WIDGETS -->
@can('mhs')
<div class="row">

    @if(is_null(Auth::user()->avatar))
    <div class="col-md-12">
        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Jangan Lupa</strong> Ubah Foto profil anda Untuk dapat mencetak Nametag Ujian
        </div>
    </div>
    @else
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Name Tag Peserta</h3>
            </div>
            <div class="panel-body">
                <a href="{{route("mahasiswa.nametag.cetak")}}" class="btn btn-primary btn-sm">Catak Name Tag</a> <br><br>
                <p>Name tag ini digunakan untuk ujian OSCE, pastikan anda membawa nametag ini selama Osce. <br>
                silahkan print dan masukan kedalam name tag.</p>
                 </div>
        </div>

    </div>
    @endif
</div>
@endcan
@can('penguji')
<div class="row">
    @if(is_null(Auth::user()->avatar))
    <div class="col-md-12">
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Jangan Lupa</strong> Untuk mengubah foto profil anda, ubah foto profil anda di menu Profile
        </div>
    </div>
    @else
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Kartu Penguji</h3>
            </div>
            <div class="panel-body">
                <a href="{{route("penguji.kartu.cetak")}}" class="btn btn-primary btn-sm">Catak Kartu Penguji</a> <br><br>
                <p>Kartu ini digunakan untuk ujian OSCE, pastikan anda membawa kartu ini selama menguji Osce. <br>
                silahkan print Kartu.</p>
                 </div>
        </div>

    </div>
    @endif
</div>
@endcan
@can('ps')
<div class="row">
    @if(is_null(Auth::user()->avatar))
    <div class="col-md-12">
        <div class="alert alert-info" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            <strong>Jangan Lupa</strong> Untuk mengubah foto profil anda, ubah foto profil anda di menu Profile
        </div>
    </div>
    @else
    <div class="col-md-12">
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Kartu Pasien Standar</h3>
            </div>
            <div class="panel-body">
                <a href="{{route("ps.kartu.cetak")}}" class="btn btn-primary btn-sm">Catak Kartu Pasien Standar</a> <br><br>
                <p>Kartu ini digunakan untuk ujian OSCE, pastikan anda membawa kartu ini selama menguji Osce. <br>
                silahkan print Kartu.</p>
                 </div>
        </div>

    </div>
    @endif
</div>
@endcan


@endsection

@section('javascript')

@endsection
