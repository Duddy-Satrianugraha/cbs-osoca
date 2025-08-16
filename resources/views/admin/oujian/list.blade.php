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
    <h2><span class="fa fa-arrow-circle-o-left"></span> Daftar Ujian Osoca</h2>
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

                                    <form action="{{ route('admin.ujian.index') }}" method="GET">
                                        <div class="col-md-4">
                                    <div class="input-group">

                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                        <input type="text" class="form-control" name="search" placeholder="Cari Ujian" value="{{ request('search') }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary">Search</button>
                                            <a href="{{route('admin.ujian.index')}}" class="btn btn-default">Clear</a>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                    <ul class="panel-controls">

                                        <li><a href="{{ route('admin.ujian.create')}}" class="panel-add"><span class="fa fa-plus"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">Nomor</th>
                                                    <th>Nama Ujian</th>
                                                    <th width="400">Parameter</th>
                                                    <th width="200">tanggal</th>
                                                    <th width="300">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i =  1;@endphp
                                                @foreach ($ujian as $data)
                                                <tr id="trow_{{$i}}">
                                                    <td class="text-center">{{$i}}</td>
                                                    <td>{{$data->name}} ({{$data->ta}})</td>
                                                    <td>
                                                         <a class="badge badge-deafult"> {{ $data->jml_station }} station</a>
                                                        <a class="badge badge-primary"> {{ $data->jml_sesi }} sesi</a>
                                                    </td>
                                                    <td>{{$data->tgl_ujian}}</td>
                                                    <td>
                                                        <a href="{{ route("admin.ujian.show", $data->id)}}" class="btn btn-info btn-sm"><span class="fa fa-search"></span>Lihat Sesi</a>
                                                         <a href="{{ route("admin.ujian.edit", $data->id)}}" class="btn btn-warning btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                                        <form id="del-temp-{{$data->id}}" action="{{ route('admin.ujian.destroy', $data->id)}}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-rounded btn-sm" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus ujian ini?');"><span class="fa fa-times"></span></button>
                                                        </form>
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
