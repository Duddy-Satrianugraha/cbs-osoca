@extends('layouts.app')

@section('css')
<link rel="stylesheet" type="text/css" id="theme" href="{{asset('js/plugins/summernote/summernote-lite.min.css')}}"/>
@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.templates.index')}}">daftar template</a></li>
        <li class="active">Template {{ $template->judul_station }}</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Template Soal   {{ $template->judul_station }}</h2>
</div>
@endsection
@section('content')

<div class="row">
    <div class="row">
        <div class="col-md-12">

            <form class="form-horizontal" action="{{ route('admin.templates.pasien.update', $template->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Instruksi </strong>Pasien Simulasi</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-body form-group-separated">

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Identitas Pasien</label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ips_identitas">{{ $template->ips_identitas }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Riwayat Penyakit Sekarang</label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ips_rp_sekarang">{{ $template->ips_rp_sekarang }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Riwayat Penyakit Terdahulu</label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ips_rp_dahulu">{{ $template->ips_rp_dahulu }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Riwayat Penyakit Keluarga</label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ips_rp_keluarga">{{ $template->ips_rp_keluarga }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Riwayat Pribadi/Sosial </label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ips_r_pribadi">{{ $template->ips_r_pribadi }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Pertanyaan Wajib </label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ips_pertanyaan_wajib">{{ $template->ips_pertanyaan_wajib }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Peran Wajib </label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ips_peran_wajib">{{ $template->ips_peran_wajib }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Molase </label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin_pic" name="ips_molase">{{ $template->ips_molase }}</textarea>
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
    $(".summernote_osin").summernote({height: 250, focus: true,
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

    $(".summernote_osin_pic").summernote({height: 250, focus: true,
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
<script>
    document.getElementById('penunjang_file').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('penunjang_preview').src = e.target.result;
                document.getElementById('penunjang_preview').height = 200;
                document.getElementById('penunjang_file').style.display = 'none';
            };
            reader.readAsDataURL(this.files[0]);


        }
    });
    </script>
@endsection
