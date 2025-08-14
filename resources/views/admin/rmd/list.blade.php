@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
        <li class="active">RMD</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Daftar Pemeriksaan Penunjang Rekamedik Digital</h2>
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
                                    <h3 class="panel-title">Rekamedik Digital</h3>

                                    <form action="{{ route('admin.rmd.index') }}" method="GET">
                                        <div class="col-md-4">
                                    <div class="input-group">

                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                        <input type="text" class="form-control" name="search" placeholder="Cari Ujian" value="{{ request('search') }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary">Search</button>
                                            <a href="{{route('admin.rmd.index')}}" class="btn btn-default">Clear</a>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                    <ul class="panel-controls">

                                        <li><a href="{{ route('admin.rmd.create')}}" class="panel-add"><span class="fa fa-plus"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">Nomor</th>
                                                    <th>Jenis Pemeriksaan</th>
                                                    <th>Nama Pemeriksaan</th>
                                                    <th>Nilai Default Dewasa</th>
                                                    <th>Nilai Default Anak-anak</th>
                                                    <th>Nilai Rujukan Dewasa</th>
                                                    <th>Nilai Rujukan Anak-anak</th>
                                                    <th width="300">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i =  1;@endphp
                                                @foreach ($rme as $data)
                                                <tr id="trow_{{$i}}">
                                                    <td class="text-center">{{$i}}</td>
                                                    <td>Laboratorium</td>
                                                    <td>Hemoglobin (Hb)</td>
                                                    <td>15 g/dL</td>
                                                    <td>14 g/dL</td>
                                                    <td>13-17 g/dL</td>
                                                    <td>11-16 g/dL</td>
                                                    <td>
                                                        <a href="{{ route("admin.rmd.show", $data->id)}}" class="btn btn-info btn-sm"><span class="fa fa-search"></span>Lihat Sesi</a>
                                                         <a href="{{ route("admin.rmd.edit", $data->id)}}" class="btn btn-warning btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                                        <form id="del-temp-{{$data->id}}" action="{{ route('admin.rmd.destroy', $data->id)}}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-rounded btn-sm" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus Data ini?');"><span class="fa fa-times"></span></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @php $i++;@endphp
                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{ $rme->appends(['search' => request('search')])->links() }}

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
