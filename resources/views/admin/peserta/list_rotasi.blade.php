@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.rotasi.index')}}">Daftar Ujian</a></li>
        <li class="active">Rotasi</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> List Rotasi Ujian {{$ujian->name}}</h2>
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
                                    <h3 class="panel-title">List Rotasi </h3>

                                    <form action="{{ route('admin.rotasi.show', $ujian->id) }}" method="GET">
                                        <div class="col-md-4">
                                    <div class="input-group">

                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                        <input type="text" class="form-control" name="search" placeholder="Cari Rotasi" value="{{ request('search') }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary">Search</button>
                                            <a href="{{route('admin.rotasi.show', $ujian->id)}}" class="btn btn-default">Clear</a>
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
                                                    <th>Daftar Rotasi</th>
                                                    <th>Parameter</th>
                                                    <th width="100">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i =  1;@endphp
                                                @foreach ($list as $data)
                                                <tr id="trow_{{$loop->iteration}}">
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td>{{$data->full_name}}</td>
                                                    <td>
                                                        <a href="{{ route('admin.pdf.peserta', $data->id)}}" class="btn btn-info btn-sm"><span class="fa fa-users"></span> Cetak Daftar Peserta</a>
                                                        <button class="badge badge-primary badge-sm"> Slot peserta tersedia {{$data->peserta_null_count}} </button>
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('admin.rotasi.edit', $data->id)}}" class="btn btn-info btn-sm"><span class="fa fa-search"></span>Daftar Peserta</a>

                                                    </td>
                                                </tr>
                                                @php $i++;@endphp
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
