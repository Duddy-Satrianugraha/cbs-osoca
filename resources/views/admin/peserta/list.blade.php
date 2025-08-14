@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
        <li class="active">Ujian</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Daftar Ujian</h2>
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
                                    <h3 class="panel-title">List Ujian</h3>

                                    <form action="{{ route('admin.rotasi.index') }}" method="GET">
                                        <div class="col-md-4">
                                    <div class="input-group">

                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                        <input type="text" class="form-control" name="search" placeholder="Cari Ujian" value="{{ request('search') }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary">Search</button>
                                            <a href="{{route('admin.rotasi.index')}}" class="btn btn-default">Clear</a>
                                        </div>
                                    </div>
                                </div>
                                </form>

                                </div>
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">Nomor</th>
                                                    <th>Nama Ujian</th>
                                                    <th width="300">Parameter</th>
                                                    <th width="100">Pendaftaran</th>
                                                    <th width="100">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i =  1;@endphp
                                                @foreach ($ujian as $data)
                                                <tr id="trow_{{$i}}">
                                                    <td class="text-center">{{$i}}</td>
                                                    <td>{{$data->name}} ({{$data->ta}})</td>
                                                    <td>
                                                        @php $peserta =  $data->rotations()->count() * ($data->sesi()->first() ? $data->sesi()->first()->jml_station : 0 );@endphp
                                                        <a class="badge badge-deafult"> {{ $data->sesi()->count() }} sesi</a>
                                                        <a class="badge badge-primary"> {{ $data->locations()->count() }} lokasi</a>
                                                        <a class="badge badge-success"> {{ $data->rotations()->count() }} rotasi</a>
                                                        <a class="badge badge-danger"> {{ $peserta }} Peserta</a>

                                                    </td>
                                                    <td> @if(is_null($data->daftar_peserta))
                                                        <a href="{{ route('admin.act.ujian.open', $data->id)}}" class="badge badge-danger">Buka Pendaftaran</a>
                                                        @else
                                                        <a href="{{ route('admin.act.ujian.close', $data->id)}}" class="badge badge-info">Tutup Pendaftaran</a>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <a href="{{ route("admin.rotasi.show", $data->id)}}" class="btn btn-info btn-sm"><span class="fa fa-search"></span>Daftar Rotasi Ujian</a>

                                                    </td>
                                                </tr>
                                                @php $i++;@endphp
                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{ $ujian->appends(['search' => request('search')])->links() }}

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

@endsection
