@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.templates.index')}}">Template Ujian Osoca</a></li>
        <li class="active">Copy Template</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Copy Template </h2>
</div>
@endsection
@section('content')

<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ route('admin.templates.copy.store') }}" method="POST">
                @csrf
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Copy</strong> Template</h3>
                    <ul class="panel-controls">
                        <li><a href="{{ route('admin.templates.index') }}" ><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-body form-group-separated">

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nama Template Baru</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="nama_template" value="{{ old('nama_template') }}"/>
                            <small class="text">Pilih yang anda mudah ingat |Tidak di tampilkan pada penguji</small>
                        </div>

                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Pilih Template yang akan di copy</label>
                        <div class="col-md-8 col-xs-12">
                            <select class="form-control" name='old_id_template'>
                                @foreach($templates as $data)
                                <option value ='{{ $data->id}}' > <strong>{{$data->nama_template}}</strong> -- {{ $data->judul_station}}</option>
                                @endforeach

                            </select>

                        </div>
                    </div>

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
