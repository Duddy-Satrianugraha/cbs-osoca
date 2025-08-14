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
    <div class="col-md-12">

        <form class="form-horizontal">

            <div class="panel panel-default tabs">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Data Template</a></li>
                    <li><a href="#tab-second" role="tab" data-toggle="tab">Instruksi Peserta Ujian </a></li>
                    <li><a href="#tab-third" role="tab" data-toggle="tab">Instruksi Penguji </a></li>
                    <li><a href="#tab-fourth" role="tab" data-toggle="tab">Foto Periksaan Penunjang </a></li>
                </ul>
                <div class="panel-body tab-content">
                    <div class="tab-pane active" id="tab-first">
                        <p>Silahkan simpan sebelum pindah ke tab selanjutnya</p>
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
                            <label class="col-md-2 col-xs-12 control-label">Kompetensi Diujikan</label>
                            <div class="col-md-8 col-xs-12">
                                <label class="check"><input type="checkbox" class="icheckbox" name='komptensi_yang_diujikan []' value="1" /> <span></span> Anamnesis</label> <br/>
                                <label class="check"><input type="checkbox" class="icheckbox" name='komptensi_yang_diujikan []' value="2" /> <span></span> Pemeriksaan fisik</label> <br/>
                                <label class="check"><input type="checkbox" class="icheckbox" name='komptensi_yang_diujikan []' value="3" /> <span></span> Interpretasi data/kemampuan prosedural pemeriksaan penunjang</label> <br/>
                                <label class="check"><input type="checkbox" class="icheckbox" name='komptensi_yang_diujikan []' value="4" /> <span></span> Penegakan diagnosis dan diagnosis banding</label> <br/>
                                <label class="check"><input type="checkbox" class="icheckbox" name='komptensi_yang_diujikan []' value="5" /> <span></span> Tatalaksana nonfarmakoterapi</label> <br/>
                                <label class="check"><input type="checkbox" class="icheckbox" name='komptensi_yang_diujikan []' value="6" /> <span></span> Tatalaksana farmakoterapi</label> <br/>
                                <label class="check"><input type="checkbox" class="icheckbox" name='komptensi_yang_diujikan []' value="7" /> <span></span> Komunikasi dan edukasi pasien</label> <br/>
                                <label class="check"><input type="checkbox" class="icheckbox" name='komptensi_yang_diujikan []' value="8" /> <span></span> Perilaku professional</label> <br/>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Kategori Sistem Tubuh</label>
                            <div class="col-md-8 col-xs-12">
                                <label class="switch"><input type="radio"  name='kategori_sistem_tubuh []' value="1" /> <span></span> Sistem Syaraf </label> <br/>
                                <label class="switch"><input type="radio"  name='kategori_sistem_tubuh []' value="2" /> <span></span> Psikiatri </label> <br/>
                                <label class="switch"><input type="radio"  name='kategori_sistem_tubuh []' value="3" /> <span></span> Sistem Indra </label> <br/>
                                <label class="switch"><input type="radio"  name='kategori_sistem_tubuh []' value="4" /> <span></span> Sistem Respirasi </label> <br/>
                                <label class="switch"><input type="radio"  name='kategori_sistem_tubuh []' value="5" /> <span></span> Sistem Gastrointestinal, Hepatobilier, dan Pankreas</label> <br/>
                                <label class="switch"><input type="radio"  name='kategori_sistem_tubuh []' value="6" /> <span></span> Sistem Ginjal dan Saluran Kemih</label> <br/>
                                <label class="switch"><input type="radio"  name='kategori_sistem_tubuh []' value="7" /> <span></span> Sistem Reproduksi</label> <br/>
                                <label class="switch"><input type="radio"  name='kategori_sistem_tubuh []' value="8" /> <span></span> Sistem Endokrin, Metabolisme, dan Nutrisi</label> <br/>
                                <label class="switch"><input type="radio"  name='kategori_sistem_tubuh []' value="9" /> <span></span> Sistem Hematologi dan Imunologi</label> <br/>
                                <label class="switch"><input type="radio"  name='kategori_sistem_tubuh []' value="10" /> <span></span> Sistem Muskuloskeletal</label> <br/>
                                <label class="switch"><input type="radio"  name='kategori_sistem_tubuh []' value="11" /> <span></span> Sistem Integumen</label> <br/>
                            </div>
                        </div>





                    </div>
                    <div class="tab-pane" id="tab-second">
                        <p>Silahkan simpan sebelum pindah ke tab selanjutnya</p>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Skenario Klinik</label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Tugas</label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>


                    </div>
                    <div class="tab-pane" id="tab-third">
                        <p>Silahkan simpan sebelum pindah ke tab selanjutnya</p>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Instruksi Umum</label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Instruksi Khusus : </label>
                            <div class="col-md-8 col-xs-12">

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Penguji menilai anamnesis</label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Penguji menilai pemeriksaan fisik </label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Penguji menilai pemeriksaan penunjang</label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Penguji menilai diagnosis dan dua diagnosis banding</label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Penguji menilai tatalaksana Non farmakoterapi </label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Penguji menilai tatalaksana farmakoterapi </label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Penguji menilai komunikasi dan edukasi  </label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Penguji menilai perilaku profesional   </label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="tab-fourth">
                        <p>Silahkan simpan sebelum pindah ke tab selanjutnya</p>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Skenario Klinik</label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-2 col-xs-12 control-label">Tugas</label>
                            <div class="col-md-8 col-xs-12">
                                <textarea class="form-control summernote_osin"></textarea>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-primary pull-right">Save Changes <span class="fa fa-floppy-o fa-right"></span></button>
                </div>
            </div>

        </form>

    </div>
</div>




@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('js/plugins/summernote/summernote.js')}}"></script>
@endsection
