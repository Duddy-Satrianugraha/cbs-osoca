@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" id="theme" href="{{asset('js/plugins/summernote/summernote-lite.min.css')}}"/>


@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.templates.index')}}">daftar template</a></li>
        <li class="active">Template {{ $otemplate->judul_station }}</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Soal Osoca  {{ $otemplate->judul_station }}</h2>
</div>
@endsection
@section('content')

<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ route('admin.templates.soal.update', $otemplate->id) }}" method="POST">
                @csrf
                @method('put')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Soal Peserta </strong> Peserta</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-body form-group-separated">

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Skenario Klinik </label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin_pic" name="soal">{{$otemplate->soal}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Tugas Mahasiswa</label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="tugas_mhs">{{$otemplate->tugas_mhs}}</textarea>
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
<script type="text/javascript" src="{{ asset('js/plugins/summernote/summernote-lite.min.js')}}"></script>
<script>
    $(".summernote_osin").summernote({height: 150, focus: true,
                                                  toolbar: [
                                                      ['style', ['bold', 'italic', 'underline', 'clear']],
                                                      ['font', ['strikethrough', 'fontsize']],
                                                      ['fontstyle', ['fontname']],
                                                      ['color', ['color']],
                                                      ['table', ['table']],
                                                      ['para', ['ul', 'ol', 'paragraph']],
                                                      ['height', ['height']],
                                                      ['view', [ 'codeview']],

                                                  ],
                                                  callbacks: {
                                                            onPaste: function (e) {
                                                                e.preventDefault();
                                                                var bufferText = (e.originalEvent || e).clipboardData.getData('text/plain');
                                                                document.execCommand('insertText', false, bufferText);
                                                            }
                                                        }
                                                 });

    $(".summernote_osin_pic").summernote({height: 550, focus: true,
                                                  toolbar: [
                                                      ['style', ['bold', 'italic', 'underline', 'clear']],
                                                      ['font', ['strikethrough', 'fontsize']],
                                                      ['fontstyle', ['fontname']],
                                                      ['color', ['color']],
                                                      ['table', ['table','picture']],
                                                      ['para', ['ul', 'ol', 'paragraph']],
                                                      ['height', ['height']],
                                                      ['view', [ 'codeview']],
                                                      ['custom', ['pastePlainText']]
                                                  ],
                                                  callbacks: {
                                                    onPaste: function (e) {
                                                        e.preventDefault();
                                                        var bufferText = (e.originalEvent || e).clipboardData.getData('text/plain');
                                                        document.execCommand('insertText', false, bufferText);
                                                    }
                                                    }
                                                 });
</script>


@endsection
