@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.ujian.index')}}">Daftar Ujian</a></li>
        <li class="active">Ujian Baru</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left">Ujian</span> Baru</h2>
</div>
@endsection
@section('content')

<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ route('admin.ujian.store') }}" method="POST">
                @csrf
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Buat Ujian</strong>Baru</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-body form-group-separated">

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nama Ujian</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="name" value="{{ old('Name') }}"/>
                            <small class="text">Pilih yang anda mudah ingat |Tidak di tampilkan pada penguji</small>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tahun Akademik</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="tahun_akademik" value="{{ old('tahun_akademik') }}"/>
                            <small class="text">pastikan menulis tahun akademik berjalan contoh :2029/2030</small>
                        </div>

                    </div>
                </div>
                <div class="panel-footer">

                    <a  class="btn btn-default" href="{{ route('admin.ujian.index') }}">Kembali</a>
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
