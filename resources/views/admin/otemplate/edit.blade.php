@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.templates.index')}}">daftar template</a></li>
        <li class="active">Edit Template {{ $template->judul_station }}</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Template  {{ $template->judul_station }}</h2>
</div>
@endsection
@section('content')

<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ route('admin.templates.update', $template->id) }}" method="POST">
                @csrf
                @method('put')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Template</strong>Soal</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-body form-group-separated">

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nama Template</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="nama_template" value="{{ $template->nama_template }}"/>
                            <small class="text">Pilih yang anda mudah ingat |Tidak di tampilkan pada penguji</small>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nomor Soal</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="nomor_soal" value="{{ $template->nomor_station }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Judul Soal</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="judul_soal" value="{{ $template->judul_station }}"/>
                        </div>
                    </div>
                   
                  


                    <!-- Div yang akan ditampilkan jika dicentang -->

                        
                </div>
                <div class="panel-footer">

                    <a  class="btn btn-default" href="{{ route('admin.templates.index') }}">Kembali</a>
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
