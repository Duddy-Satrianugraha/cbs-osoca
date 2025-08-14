@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.ujian.index')}}">Daftar Ujian</a></li>
    <li ><a href="{{ route('admin.ujian.show', $ujian->id)}}">Daftar Sesi</a></li>
        <li class="active">Copy Sesi</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Copy Sesi</h2>
</div>
@endsection
@section('content')

<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ route('admin.sesi.copy.store', $ujian->id) }}" method="POST">
                @csrf
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Sesi</strong>ujian</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-body form-group-separated">

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nama Sesi Baru</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="nama_sesi" value="{{ old('nama_sesi') }}"/>
                            <small class="text">Pilih yang anda mudah ingat |Tidak di tampilkan pada penguji</small>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tanggal Sesi Baru</label>
                        <div class="col-md-8 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                <input type="text" name='tgl_ujian' class="form-control datepicker" value="">
                            </div>
                            <span class="help-block">Pilih Tanggal pelaksanaan Sesi Ujian Baru</span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Pilih Sesi yang akan di copy</label>
                        <div class="col-md-8 col-xs-12">
                            <select class="form-control" name='old_id_sesi'>
                                @foreach($sesi as $data)
                                <option value ='{{ $data->id}}' > <strong>{{$data->name}}</strong> -- {{ $data->tgl_ujian}}</option>
                                @endforeach

                            </select>

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
