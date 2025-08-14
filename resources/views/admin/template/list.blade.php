@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
        <li class="active">Template Ujian</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Template Ujian</h2>
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
                                    <h3 class="panel-title">List Template Ujian</h3>

                                    <form action="{{ route('admin.templates.index') }}" method="GET">
                                        <div class="col-md-4">
                                    <div class="input-group">

                                        <div class="input-group-addon">
                                            <span class="fa fa-search"></span>
                                        </div>
                                        <input type="text" class="form-control" name="search" placeholder="Cari template" value="{{ request('search') }}">
                                        <div class="input-group-btn">
                                            <button class="btn btn-primary">Search</button>
                                            <a href="{{route('admin.templates.index')}}" class="btn btn-default">Clear</a>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                    <ul class="panel-controls">
                                        <li><a href="{{ route('admin.templates.copy')}}" class="panel-add"><span class="fa fa-copy"></span></a></li>
                                        <li><a href="{{ route('admin.templates.create')}}" class="panel-add"><span class="fa fa-plus"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">Nomor</th>
                                                    <th width="200">Nama Template</th>
                                                    <th width="400">judul</th>
                                                    <th width="200">dibuat</th>
                                                    <th >kelengkapan</th>
                                                    <th>actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i =  1;@endphp
                                                @foreach ($templates as $data)

                                                <tr id="trow_{{$i}}">
                                                    <td class="text-center">{{$i}}</td>
                                                    <td>{{$data->nama_template}}</td>
                                                    <td><strong>{{$data->judul_station}}</strong> ( {{$data->nomor_station}} )</td>
                                                    <td>{{$data->created_at}}</td>
                                                    <td>
                                                        <a href="{{ route("admin.templates.peserta", $data)}}" class="btn btn-info btn-sm"> Instruksi Peserta</a>
                                                        <a href="{{ route("admin.templates.penguji", $data->id)}}" class="btn btn-info btn-sm"> Instruksi Penguji</a>
                                                        @if($data->use_rmd)
                                                        <a href="{{ route("admin.templates.rekamedik", $data->id)}}" class="btn btn-info btn-sm"> Rekamedik Digital</a>
                                                        @endif
                                                        <a href="{{ route("admin.templates.pasien", $data->id)}}" class="btn btn-info btn-sm"> Instruksi Pasien</a>
                                                        <a href="{{ route("admin.templates.rubrik", $data->id)}}" class="btn btn-info btn-sm"> Rubrik Ujian</a>
</td>
                                                    <td>
                                                        <a href="{{ route("admin.templates.show", $data->id)}}" class="btn btn-info"><span class="fa fa-search"></span></a>
                                                        <a href="{{ route("admin.templates.edit", $data->id)}}" class="btn btn-warning btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                                        <form id="del-temp-{{$data->id}}" action="{{ route('admin.templates.destroy', $data->id)}}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-rounded btn-sm" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus template ini?');"><span class="fa fa-times"></span></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @php $i++;@endphp
                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{ $templates->appends(['search' => request('search')])->links() }}

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
