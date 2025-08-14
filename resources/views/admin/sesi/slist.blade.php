@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.ujian.index')}}">Daftar Ujian</a></li>
    <li ><a href="{{ route('admin.ujian.show', $sesi->ujian()->first()->id)}}">Daftar Sesi</a></li>
        <li class="active">Daftar Station</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Station sesi {{$sesi->name}}</h2>
</div>
@endsection
@section('content')

<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ route('admin.station.store') }}" method="POST">
                @csrf
                <input type="hidden" name="ujian_id" value="{{  $sesi->ujian()->first()->id }}">
                <input type="hidden" name="sesi_id" value="{{  $sesi->id }}">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Sesi</strong> Baru</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                       <div class="panel-body form-group-separated">
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label"> Sesi Ujian </label>
                            <div class="col-md-8 col-xs-12">
                                <p class="form-control-static">{{ $sesi->ujian()->first()->name }} - {{ $sesi->name}}</p>

                            </div>
                        </div>

                            @foreach($stations  as $station)
                            <div class="form-group">
                                <label class="col-md-2 col-xs-12 control-label"> Station {{$station->urutan}}</label>
                                <div class="col-md-8 col-xs-12">
                                    <select class="form-control select" name="station[{{$station->id}}]" data-live-search="true">
                                        <option>-- Pilih Template --</option>
                                        <option value="0" @if($station->template_id == null && $station->istirahat == true) selected @endif>Station Istirahat</option>
                                        @foreach ($st as $data)
                                        <option value="{{$data->id}}" @if($data->id == $station->template_id) selected @endif>{{$data->nama_template}}</option>
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

                    <a  class="btn btn-default" href="{{ route('admin.ujian.show',  $sesi->ujian()->first()->id) }}">Kembali</a>
                    <button class="btn btn-primary pull-right" type="submit">Submit</button>
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
