@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.templates.index')}}">daftar template</a></li>
        <li class="active">Template baru</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Template Baru</h2>
</div>
@endsection
@section('content')

<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ route('admin.templates.store') }}" method="POST">
                @csrf
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Template</strong>Soal</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-body form-group-separated">

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nama Template</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="nama_template" value="{{ old('nama_template') }}"/>
                            <small class="text">Pilih yang anda mudah ingat |Tidak di tampilkan pada penguji</small>
                        </div>

                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nomor Station</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="nomor_station" value="{{ old('nomor_station') }}"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Judul Station</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text" class="form-control" name="judul_station" value="{{ old('judul_station') }}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tingkat Kemampuan kasus yang Diujikan</label>
                        <div class="col-md-8 col-xs-12">
                            <select class="form-control" name='tingkat_kemampuan_kasus'>
                                @foreach($skdi as $datu)
                                <option value ='{{ $datu->name}}' > {{$datu->name}} - {{ $datu->value}}</option>
                                @endforeach

                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kompetensi Diujikan</label>
                        <div class="col-md-8 col-xs-12">
                            @foreach($kyd as $data)
                                <label class="check"><input type="checkbox" class="icheckbox" name='komptensi_yang_diujikan[]' value="{{$data->name}}" /> <span></span> {{$data->value}}</label> <br/>
                            @endforeach


                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Kategori Sistem Tubuh</label>
                        <div class="col-md-8 col-xs-12">
                            <select class="form-control" name='kategori_sistem_tubuh'>
                                @foreach($kst as $dat)
                                <option value ='{{ $dat->name}}'> {{ $dat->value}}</option>
                                @endforeach

                            </select>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Rekamedik Digital</label>
                        <div class="col-md-8 col-xs-12">
                            <label class="check">
                                <input type="checkbox" class="icheckbox" name="use_rmd" id="use_rmd_checkbox" value=1 />
                                <span></span> Gunakan
                            </label>
                        </div>
                    </div>

                    <!-- Div yang akan ditampilkan jika dicentang -->
                    <div id="rmd_detail" class="form-group" style="display: none;">
                        <label class="col-md-2 col-xs-12 control-label">Pasien </label>
                        <div class="col-md-8 col-xs-12">
                           <select class="form-control" name='j_pasien'>

                                <option> Pilih pasien</option>
                                <option value ='A'> Dewasa </option>
                                <option value ='C'> Anak-Anak </option>


                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">

                    <a  class="btn btn-default" href="{{ route('admin.templates.index') }}">Kembali</a>
                    <button class="btn btn-primary pull-right" type="submit">Submit</button>
                </div>
            </div>
            </form>

        </div>
    </div>
</div>




@endsection

@section('javascript')
<script>
$(document).ready(function(){
    // Event khusus iCheck
    $('#use_rmd_checkbox').on('ifChecked', function(event){
        $('#rmd_detail').slideDown(); // tampilkan div
    });

    $('#use_rmd_checkbox').on('ifUnchecked', function(event){
        $('#rmd_detail').slideUp(); // sembunyikan div
    });
});
</script>
@endsection
