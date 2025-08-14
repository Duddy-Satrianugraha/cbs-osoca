@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.ujian.index')}}">Daftar Ujian</a></li>
        <li class="active">Daftar Sesi {{$ujian->name}}</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Daftar Sesi Ujian</h2>
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
                                    <h3 class="panel-title">List Sesi {{$ujian->name}}</h3>

                                    <form action="{{ route('admin.ujian.show', $ujian->id) }}" method="GET">
                                        <div class="col-md-4">
                                    <div class="input-group">

                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                        <input type="text" class="form-control" name="search" placeholder="Cari Ujian" value="{{ request('search') }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary">Search</button>
                                            <a href="{{route('admin.ujian.show', $ujian->id)}}" class="btn btn-default">Clear</a>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                    <ul class="panel-controls">
                                        <li><a href="{{ route('admin.sesi.copy', $ujian->id)}}" class="panel-add"><span class="fa fa-copy"></span></a></li>
                                        <li>

                                            <a href="{{ route('admin.sesi.index', $ujian->id)}}" class="panel-add"><span class="fa fa-plus"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">No.</th>
                                                    <th>Nama Sesi</th>
                                                    <th width="400">Parameter</th>
                                                    <th width="200">Tanggal Ujian</th>
                                                    <th width="300">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($list as $data)
                                                <tr id="trow_{{ $loop->iteration }}">
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>
                                                        <span class="badge badge-danger">{{ $data->jml_lokasi }} lokasi</span>
                                                        <span class="badge badge-warning">{{ $data->rotasi }} rotasi</span>
                                                        <span class="badge badge-secondary">{{ $data->jml_station }} station</span>
                                                        <span class="badge badge-success">{{ $data->template_count }} template</span>
                                                        <span class="badge badge-info">{{ $data->peserta }} peserta</span>
                                                    </td>
                                                    <td>{{ \Carbon\Carbon::parse($data->tgl_ujian)->format('d-m-Y') }}</td>
                                                    <td>
                                                        <a href="{{ route('admin.sesi.show', $data->id) }}" class="btn btn-info btn-sm">
                                                            <span class="fa fa-search"></span> Lihat Station
                                                        </a>
                                                        <a href="{{ route('admin.sesi.edit', $data->id) }}" class="btn btn-warning btn-rounded btn-sm">
                                                            <span class="fa fa-pencil"></span>
                                                        </a>
                                                        <form id="del-sesi-{{ $data->id }}" action="{{ route('admin.sesi.destroy', $data->id) }}" method="POST" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-rounded btn-sm" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus ujian ini?');">
                                                                <span class="fa fa-times"></span>
                                                            </button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>

                                        {{ $list->appends(['search' => request('search')])->links() }}

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
