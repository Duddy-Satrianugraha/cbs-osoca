@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.ujian.index')}}">Daftar Ujian</a></li>
    <li ><a href="{{ route('admin.ujian.show', $ujian->id)}}">Daftar Sesi</a></li>
        <li class="active">Sesi Baru</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Sesi Baru</h2>
</div>
@endsection
@section('content')

<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ route('admin.sesi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="ujian_id" value="{{ $ujian->id }}">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Sesi</strong> Baru</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-body form-group-separated">

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nama Sesi</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"/>
                            <small class="text">Pilih yang anda mudah ingat |Tidak di tampilkan pada penguji</small>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Jumlah Lokasi</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="number" class="form-control" name="jml_lokasi" value="{{ old('jml_lokasi') }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Jumlah Rotasi Tiap lokasi</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="number" class="form-control" name="jml_rotasi" value="{{ old('jml_rotasi') }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Jumlah Station Tiap Rotasi</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="number" class="form-control" name="jml_station" value="{{ old('jml_station') }}"/>
                            <span class="text">Input jumlah station aktif dan station istirahat</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tanggal Sesi</label>
                        <div class="col-md-8 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                <input type="text" name='tgl_ujian' class="form-control datepicker" value="">
                            </div>
                            <span class="help-block">Pilih Tanggal pelaksanaan Sesi Ujian</span>
                        </div>
                    </div>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">

                    <a  class="btn btn-default" href="{{ route('admin.ujian.show', $ujian->id) }}">Kembali</a>
                    <button class="btn btn-primary pull-right" type="submit">Submit</button>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>




@endsection

@section('javascript')

@endsection
