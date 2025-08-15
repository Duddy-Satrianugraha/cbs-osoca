@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.templates.index')}}">daftar template</a></li>
        <li class="active">Template {{ $template->nama_template }}</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Template Soal   {{ $template->nama_template }}</h2>
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
                                    <h3 class="panel-title"> Soal OSOCA</h3>

                                </div>
                                <div class="panel-body">
                                    <div class="text-center">
                                        <h2>Ujian OSOCA Fakultas Kedokteran UGJ</h2>
                                        <h3>{{$template->judul_station}}</h3>
                                        <h4>{{$template->nomor_station}}</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered ">
                                            <thead>
                                                <tr>
                                                    <th width="10">No</th>
                                                    <th width="200"> </th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center">1 .</td>
                                                    <td>Nomor Soal</td>
                                                    <td>{{$template->nomor_station}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2 .</td>
                                                    <td>Judul Soal</td>
                                                    <td>{{$template->judul_station}}</td>
                                                </tr>
                                                
                                                <tr>
                                                    <td class="text-center">7 .</td>
                                                    <td>Skenario Klinik</td>
                                                    <td>                                                   
                                                         {!!$template->soal !!}  
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">7 .</td>
                                                    <td>Tugas</td>
                                                    <td>                           
                                                         {!! $template->tugas_mhs !!}
                                                    </td>
                                                </tr>
                                              
                                                <tr>
                                                    <td class="text-center" rowspan="2">8 .</td>
                                                    <td rowspan="2">Mininotes</td>
                                                    <td>
                                                        {!! $template->mininotes !!}

                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                        <hr/>
                                        <div class="text-center">
                                            <h3>Rubrik Ujian</h3>
                                            <h4>{{$template->judul_station}}</h4>
                                            <h4>{{$template->nomor_station}}</h4>
                                        </div>
                                        <table class="table table-bordered table-striped">
                                            <thead>
                                                <tr>
                                                    <th width="10">No</th>
                                                    <th width="100">Kompetensi </th>
                                                    <th width="200">Nilai 0</th>
                                                    <th width="200">Nilai 1</th>
                                                    <th width="200">Nilai 2</th>
                                                    <th width="200">Nilai 3</th>
                                                    <th width="10">Bobot</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($rubrik as $index => $data)
                                                <tr id="trow_{{$loop->iteration}}">
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td><strong>{{$data['name']}}</strong>
                                                    </td>
                                                    <td>
                                                      {!! $data['nilai_0'] !!}
                                                    </td>
                                                    <td>
                                                        {!! $data['nilai_1'] !!}
                                                    </td>
                                                    <td>
                                                       {!! $data['nilai_2'] !!}
                                                    </td>
                                                    <td>
                                                       {!! $data['nilai_3'] !!}
                                                    </td>
                                                    <td>
                                                        {!! $data['bobot'] !!}
                                                     </td>
                                                </tr>
                                                @endforeach



                                            </tbody>
                                        </table>

                                    </div>

                                </div>
                                <div class="panel-footer">

                                    <a  class="btn btn-default" href="{{ route('admin.templates.index') }}">Kembali</a>
                                </div>



                            </div>
                            </form>
                        </div>
                    </div>
                    <!-- END RESPONSIVE TABLES -->

</div>
<!-- END WIDGETS -->




@endsection

@section('javascript')

@endsection
