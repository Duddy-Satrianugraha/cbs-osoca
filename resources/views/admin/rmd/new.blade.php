@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.rmd.index')}}">Daftar Pemeriksaan</a></li>
        <li class="active">Pemeriksaan Baru</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left">Data Pemeriksaan</span> Baru</h2>
</div>
@endsection
@section('content')

<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ route('admin.rmd.store') }}" method="POST">
                @csrf
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Buat Pemeriksaan</strong>Baru</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-body form-group-separated">
                    <div class="form-group">
                                        <label class="col-md-2 col-xs-12 control-label">Jenis Pemeriksaan</label>
                                        <div class="col-md-8 col-xs-12">
                                            <select class="form-control select">
                                                @foreach($jenis as $data)
                                                <option value="{{ $data->id }}" >{{ $data->value }}</option>
                                                @endforeach
                                            </select>

                                        </div>
                                    </div>


                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nama Pemeriksaan</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="name" value="{{ old('Name') }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nilai Default Dewasa</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="ddewasa" value="{{ old('ddewasa') }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nilai Default anak-anak</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="danak" value="{{ old('danak') }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nilai Rujukan Dewasa</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="rdewasa" value="{{ old('rdewasa') }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nilai Rujukan anak-anak</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="ranak" value="{{ old('ranak') }}"/>
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
<script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap-select.js')}}"></script>

@endsection
