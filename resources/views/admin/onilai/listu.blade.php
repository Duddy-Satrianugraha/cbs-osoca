@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.nilai.index')}}">Daftar Ujian</a></li>
        <li class="active">Daftar Nilai Peserta</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Daftar Nilai Peserta Ujian {{ $ujian->name }}</h2>
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


                                  <form action="{{ route('admin.nilai.show', $ujian->id) }}" method="GET" class="row">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <span class="fa fa-search"></span>
                                            </div>
                                            <input type="text" class="form-control" name="search"
                                                placeholder="Cari nama atau NPM"
                                                value="{{ request('search') }}">
                                            <div class="input-group-btn">
                                                <button class="btn btn-primary">Search</button>
                                                <a href="{{ route('admin.nilai.show', $ujian->id) }}" class="btn btn-default">Clear</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                    <ul class="panel-controls">
                                            <li><a href="{{ route('admin.pdf.peserta', $ujian->id)}}" class="panel-add"><span class="fa fa-print"></span></a></li>
                                            <li><a href="{{ route('admin.export.nilai', $ujian->id)}}" class="panel-add"><span class="fa fa-download"></span></a></li>


                                    </ul>
                                </div>
                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">Nomor</th>
                                                    <th >Nama</th>
                                                    <th width="100">Station</th>
                                                    <th width="80">skor 1</th>
                                                    <th width="80">skor 2</th>
                                                    <th width="20">jumlah</th>
                                                    <th width="60">Nilai</th>
                                                    <th width="200">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i =  1;@endphp
                                                @foreach ($peserta as $data)
                                                @php
                                                if(!is_null($data->nilai)){
                                                    $da = json_decode($data->nilai->skor);
                                                }
                                                else{
                                                    $da = ["-","-"];
                                                }
                                                @endphp
                                                <tr id="trow_{{$i}}">
                                                    <td class="text-center">{{$i}}</td>
                                                    <td>{{$data->name}} </br> {{$data->npm}}</td>
                                                     <td>Skenario {{$data->sesi}}</td>
                                                    @foreach($da as $key => $value)
                                                    <td>{{ $value?? '-' }}</td>
                                                    @endforeach
                                                    <td>{{$data->nilai->jumlah ?? 0}}</td>
                                                    <td><strong>{{$data->nilai->nilai ?? 0}}</strong></td>
                                                    <td>
                                                        <a href="{{ route("admin.nilai.edit", $data->id)}}" class="btn btn-warning btn-sm"><span class="fa fa-pencil"></span>Edit</a>
                                                        <form id="del-temp-{{$data->id}}" action="{{ route('admin.nilai.destroy', $data->id)}}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus ujian ini?');"><span class="fa fa-times"> Hapus</span></button>
                                                        </form>
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
