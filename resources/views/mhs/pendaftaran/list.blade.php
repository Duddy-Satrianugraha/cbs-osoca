@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
        <li class="active">Daftar OSCE</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> List OSCE</h2>
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

                                    <h3 class="panel-title">ListOsce </h3>

                                </div>

                                <div class="panel-body">
                                    <div class="row">
                                        <div class="panel-group accordion">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a href="#accOneColOne">
                                                            <span class="fa fa-plus"></span><span class="xn-text"> Daftar Osce</span>
                                                        </a>
                                                    </h4>
                                                </div>

                                                <div class="panel-body" id="accOneColOne">
                                                    <form action="{{ route('mahasiswa.pendaftaran.store') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="col-md-3 control-label">Pilih OSCE</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control select" name="ujian" data-live-search="true">
                                                                    <option>Pilih Osce</option>
                                                                    @foreach($ujian as $data)
                                                                    <option value="{{ $data->id }}">{{ $data->name}} ({{$data->ta}})</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix" style="margin-bottom: 20px;"></div>

                                                        <button class="btn btn-primary pull-right" onclick="return confirm('Apakah Anda yakin ingin daftar osce ini?');"> Daftar</button>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">Nomor</th>
                                                    <th width="400">Terdaftar Osce</th>
                                                    <th >Tanggal Daftar</th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($pendaftaran as $data)
                                                <tr id="trow_{{$loop->iteration}}">
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td> {{$data->nama_osce}}</td>
                                                    <td>
                                                        {{$data->created_at}}
                                                    </td>

                                                </tr>

                                                @endforeach

                                            </tbody>
                                        </table>


                                    </div>
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
