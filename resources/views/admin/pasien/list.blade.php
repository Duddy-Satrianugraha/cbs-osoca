@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
        <li class="active">Pasien Standar</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Pasien Standar</h2>
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
                                    <h3 class="panel-title">List Users</h3>
                                    <ul class="panel-controls">
                                        <li><a href="{{ route('admin.pasien.create')}}" class="panel-add"><span class="fa fa-plus"></span></a></li>
                                    </ul>
                                </div>

                                <div class="panel-body">

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">Nomor</th>
                                                    <th>Nama</th>
                                                    <th width="100">Role</th>
                                                    <th width="100">Username</th>
                                                    <th width="100">Registrasi</th>
                                                    <th width="100">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i =  1;@endphp
                                                @foreach ($users as $data)
                                                <tr id="trow_{{$i}}">
                                                    <td class="text-center">{{$i}}</td>
                                                    <td><strong>{{$data->name}}</strong></td>
                                                    <td>{{$data->dataDiris ? "Jenis kelamin :".$data->dataDiris->sex : 'Jenis kelamin :'}}<br>
                                                    {{$data->dataDiris ? "phone :".$data->dataDiris->phone : 'phone :'}}</td>
                                                    <td>{{$data->username}}</td>
                                                    <td>{{$data->created_at}}</td>
                                                    <td>
                                                        <a href="{{ route("admin.kartu.ps", $data->id)}}" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-print"></span></a>
                                                        <a href="{{ route("admin.pasien.edit", $data)}}" class="btn btn-default btn-rounded btn-sm"><span class="fa fa-pencil"></span></a>
                                                        <form id="del-user-{{$data->id}}" action="{{ route('admin.pasien.destroy', $data->id)}}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-rounded btn-sm" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus Pasien standard ini?');"><span class="fa fa-times"></span></button>
                                                        </form>

                                                    </td>
                                                </tr>
                                                @php $i++;@endphp
                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{ $users->links() }}
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
