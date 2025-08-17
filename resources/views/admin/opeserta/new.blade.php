@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.peserta.index')}}">Daftar Ujian</a></li>
    <li ><a href="{{ route('admin.peserta.show', $ujian->id)}}">Daftar Peserta</a></li>
        <li class="active">Peserta Baru</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Peserta Baru {{ $ujian->name }}</h2>
</div>
@endsection
@section('content')

<!-- START WIDGETS -->
<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" action="{{ route('admin.peserta.store') }}" method="POST">
            <input type="hidden" name="uid" value="{{ $ujian->id }}">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Peserta</strong> Baru</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
            </div>
            <div class="panel-body form-group-separated">
                    @csrf
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Nama</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">NPM</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                            <input type="text" name="npm" class="form-control" value="{{ old('npm') }}"/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Station</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-users"></span></span>
                            <input type="number" name="kelompok" class="form-control" value="{{ old('kelompok') }}"/>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Urutan</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-list-ol"></span></span>
                            <input type="number" name="urutan" class="form-control" value="{{ old('urutan') }}"/>
                        </div>
                    </div>
                </div>

            </div>
            <div class="panel-footer">
                <a href="{{ route('admin.peserta.show', $ujian->id)}}" class="btn btn-default">Return</a>
                <button type="submit"  class="btn btn-primary pull-right">Submit</button>
            </div>
        </div>

        </form>
    </div>
</div>
<!-- END WIDGETS -->




@endsection

@section('javascript')

@endsection
