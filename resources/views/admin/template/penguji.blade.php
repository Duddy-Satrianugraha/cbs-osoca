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

            <form class="form-horizontal" action="{{ route('admin.templates.penguji.update', $template->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Instruksi </strong>Penguji</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-body form-group-separated">

                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Instruksi Umum</label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ip_instruksi_umum">{{ $template->ip_instruksi_umum }}</textarea>
                        </div>
                    </div>
                    @php
                        $kyd = explode(',', $template->komptensi_yang_diujikan);

                    @endphp
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Instruksi Khusus : </label>
                        <div class="col-md-8 col-xs-12">

                        </div>
                    </div>
                    @if(in_array('1', $kyd))
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Penguji menilai anamnesis</label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ip_ik_anamnesis">{{ $template->ip_ik_anamnesis }}</textarea>
                        </div>
                    </div>
                    @endif

                    @if(in_array('2', $kyd))
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Penguji menilai pemeriksaan fisik </label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin_pic" name="ip_ik_p_fisik">{{$template->ip_ik_p_fisik}}</textarea>
                        </div>
                    </div>
                    @endif
                    @if(in_array('3', $kyd))
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Penguji menilai pemeriksaan Tanda Tanda Vital </label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin_pic" name="ip_ik_ttv">{{$template->ip_ik_ttv}}</textarea>
                        </div>
                    </div>
                    @endif
                    @if(in_array('4', $kyd))
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Penguji menilai pemeriksaan penunjang</label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin_pic" name="ip_ik_p_penunjang">{{$template->ip_ik_p_penunjang}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">File Pemeriksaan Penunjang</label>
                        <div class="col-md-8 col-xs-12">
                            @if($template->file_pp)
                                <img id="penunjang_preview" src="{{ asset('storage/'.$template->file_pp) }}" alt="" />
                                <a href="{{ route('admin.templates.del_pp', $template->id) }}" id="penunjang_file" class="btn btn-danger btn-sm">Hapus</a>
                                @else
                            <img id="penunjang_preview" src="" alt="" />
                            <input id="penunjang_file" type="file" class="btn-primary" name="file_pp" id="filename" title="Browse file"/>
                            @endif
                            <span class="help-block">Hanya dapat di isi file image, dan isi hanya jika ada foto pemeriksaan penunjang</span>
                        </div>
                    </div>
                    @endif
                    @if(in_array('5', $kyd))
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Penguji menilai diagnosis dan dua diagnosis banding</label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ip_ik_diagnosis">{{$template->ip_ik_diagnosis}}</textarea>
                        </div>
                    </div>
                    @endif
                    @if(in_array('6', $kyd))
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Penguji menilai tatalaksana Non farmakoterapi </label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin_pic" name="ip_ik_non_farmakoterapi">{{ $template->ip_ik_non_farmakoterapi }}</textarea>
                        </div>
                    </div>
                    @endif
                    @if(in_array('7', $kyd))
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Penguji menilai tatalaksana farmakoterapi </label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ip_ik_farmakoterapi">{{ $template->ip_ik_farmakoterapi }}</textarea>
                        </div>
                    </div>
                    @endif
                    @if(in_array('8', $kyd))
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Penguji menilai komunikasi dan edukasi  </label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ip_ik_kom_edu">{{ $template->ip_ik_kom_edu }}</textarea>
                        </div>
                    </div>
                    @endif
                    @if(in_array('9', $kyd))
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Penguji menilai perilaku profesional   </label>
                        <div class="col-md-8 col-xs-12">
                            <textarea class="form-control summernote_osin" name="ip_ik_perilaku">{{ $template->ip_ik_perilaku }}</textarea>
                        </div>
                    </div>
                    @endif
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
