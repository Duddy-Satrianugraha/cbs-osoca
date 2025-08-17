@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.peserta.index')}}">Daftar Ujian</a></li>
        <li class="active">Daftar Peserta</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Daftar Peserta Ujian {{ $ujian->name }}</h2>
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
                                    <h3 class="panel-title">List peserta Ujian</h3>

                                    <form action="{{ route('admin.peserta.show', $ujian->id) }}" method="GET">
                                        <div class="col-md-4">
                                    <div class="input-group">

                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                        <input type="text" class="form-control" name="search" placeholder="Cari Ujian" value="{{ request('search') }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary">Search</button>
                                            <a href="{{route('admin.peserta.show', $ujian->id)}}" class="btn btn-default">Clear</a>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                    <ul class="panel-controls">
                                            <li><a href="{{ route('admin.peserta.upload', $ujian->id)}}" class="panel-add"><span class="fa fa-upload"></span></a></li>
                                            <li><a href="{{ route('admin.peserta.create', $ujian->id)}}" class="panel-add"><span class="fa fa-plus"></span></a></li>
                                        
                                    </ul>
                                </div>
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">Nomor</th>
                                                    
                                                    <th width="200">Station</th>
                                                    <th width="200">Urutan</th>
                                                    <th>Nama</th>
                                                    <th >NPM</th>
                                                    <th width="300">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i =  1;@endphp
                                                @foreach ($peserta as $data)
                                                <tr id="trow_{{$i}}">
                                                    <td class="text-center">{{$i}}</td> 
                                                    <td>Station {{$data->station}}</td>
                                                    <td>Sesi {{$data->sesi}}</td>
                                                    <td>{{$data->name}} </td>
                                                    <td>{{$data->npm}}</td>
                                                   
                                                    
                                                    <td>
                                                        <a href="{{ route("admin.peserta.show", $data->id)}}" class="btn btn-info btn-sm"><span class="fa fa-search"></span>Daftar Peserta</a>
                                                        
                                                    </td>
                                                </tr>
                                                @php $i++;@endphp
                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{ $peserta->appends(['search' => request('search')])->links() }}

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
