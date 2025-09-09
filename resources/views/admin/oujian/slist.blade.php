@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.ujian.index')}}">Daftar Ujian</a></li>
        <li class="active">Daftar Sesi</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Sesi Ujian {{$oujian->name}}</h2>
</div>
@endsection
@section('content')

<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ route('admin.sesi.store') }}" method="POST">
                @csrf
                <input type="hidden" name="ujian_id" value="{{  $oujian->id }}">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Daftar</strong> Sesi</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                       <div class="panel-body form-group-separated">
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label"> Sesi Ujian </label>
                            <div class="col-md-8 col-xs-12">
                                <p class="form-control-static">{{ $oujian->name }} </p>

                            </div>
                        </div>

                            @foreach($osesi  as $station)
                            <div class="form-group">
                                <label class="col-md-2 col-xs-12 control-label"> SESI {{$station->urutan}}</label>
                                <div class="col-md-8 col-xs-12">
                                    <select class="form-control select" name="sesi[{{$station->id}}]" data-live-search="true">
                                        <option value=null >-- Pilih Template --</option>
                                        @foreach ($otemplate as $data)
                                        <option value="{{$data->id}}" @if($data->id == $station->otemplate_id) selected @endif>{{$data->nama_template}}</option>
                                        @endforeach

                                    </select>
                                    <span class="help-block">pilih Template</span>
                                </div>
                            </div>

                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="panel-footer">

                    <a  class="btn btn-default" href="{{ route('admin.ujian.index') }}">Kembali</a>
                    <button class="btn btn-primary" type="submit">Simpan</button>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>




@endsection

@section('javascript')
<script type="text/javascript" src="{{asset('/js/plugins/bootstrap/bootstrap-select.js')}}"></script>
@endsection
