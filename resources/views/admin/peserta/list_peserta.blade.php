@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.rotasi.index')}}">Daftar Ujian</a></li>
    <li ><a href="{{ route('admin.rotasi.show', $ujian->id)}}">Daftar Rotasi</a></li>
        <li class="active">Daftar Peserta</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> List Peserta Ujian {{$ujian->name}} - {{ $rotation->full_name}}</h2>
</div>
@endsection
@section('content')

<!-- START WIDGETS -->
<div class="row">
                    <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">

                                    <h3 class="panel-title">List Peserta {{ $rotation->nama }} </h3>

                                </div>

                                <div class="panel-body">

                                    <div class="table">
                                        <form action="{{ route('admin.rotasi.update', $rotation->id) }}" method="post" class="form-horizontal" id="form-scan">
                                            @csrf
                                            @method('PUT')

                                        <table class="table table-bordered table-striped ">
                                            <thead>
                                                <tr>
                                                    <th width="50">Nomor</th>
                                                    <th width="400">Station</th>
                                                    <th >Peserta</th>

                                                </tr>
                                            </thead>
                                            <tbody>


                                                @foreach ($peserta as $data)
                                                <tr id="trow_{{$loop->iteration}}">
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td>Station {{$data->urutan}}</td>
                                                    <td>
                                                            <div class="form-group">
                                                                <label class="col-md-3 control-label">Pilih peserta</label>
                                                                <div class="col-md-9">
                                                                    <select class="form-control select" name="pendaftar_id[{{$data->id}}]" data-live-search="true">
                                                                        <option value=null>-- Pilih Peserta --</option>
                                                                        @foreach($pendaftar as $datax)
                                                                        <option value="{{ $datax->id }}" @if($data->user_id == $datax->user_id) selected @endif>{{ $datax->user()->first()->name}} ({{$datax->user()->first()->username}})</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>

                                                    </td>

                                                </tr>

                                                @endforeach

                                            </tbody>
                                        </table>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                        </form>

                                    </div>

                                </div>



                            </div>

                        </div>
                    </div>
                    <!-- END RESPONSIVE TABLES -->

</div>
<!-- END WIDGETS -->




@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap-select.js')}}"></script>

@endsection
