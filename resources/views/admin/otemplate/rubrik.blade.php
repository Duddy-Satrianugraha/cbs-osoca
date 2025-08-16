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
    <h2><span class="fa fa-arrow-circle-o-left"></span> Template Soal   {{ $otemplate->judul_station }}</h2>
</div>
@endsection
@section('content')

<!-- START WIDGETS -->
<div class="row">
                    <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">
                            <form action="{{route('admin.templates.rubrik.update',$otemplate->id)}}" method="POST">
                                @csrf
                                @method('put')
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Rubrik Ujian</h3>

                                </div>
                                <div class="panel-body">
                                    <button type="button" id="checkAllAktif" class="btn btn-success btn-sm">Aktifkan Semua</button>
                                    <button type="button" id="uncheckAllAktif" class="btn btn-danger btn-sm">Nonaktifkan Semua</button>

                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="10">No</th>
                                                    <th width="100">Kompetensi </th>
                                                    <th>Nilai 0</th>
                                                    <th >Nilai 1</th>
                                                    <th >Nilai 2</th>
                                                    <th >Nilai 3</th>
                                                    <th  >Bobot</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($rubrik as $index => $data)
                                                <tr id="trow_{{$loop->iteration}}">
                                                    <td class="text-center">{{$loop->iteration}}</td>
                                                    <td>{{$data['komp']}}
                                                        <input type="hidden" name="id[]" value="{{ $data['id'] }}">
                                                    </td>
                                                        <td>
                                                        <input type="hidden" name="aktif0[{{$index}}]" value="0">
                                                        <label class="check">
                                                            <input type="checkbox" class="icheckbox" name="aktif0[{{$index}}]" value="1" {{ isset($data['aktif0']) && $data['aktif0'] == 1 ? 'checked' : '' }}>
                                                            <span></span> aktif
                                                        </label>
                                                        <textarea name="Nilai_0[]" class="form-control summernote_osin">{{ $data['nilai_0'] }}</textarea>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="aktif1[{{$index}}]" value="0">
                                                        <label class="check">
                                                            <input type="checkbox" class="icheckbox" name="aktif1[{{$index}}]" value="1" {{ isset($data['aktif1']) && $data['aktif1'] == 1 ? 'checked' : '' }}>
                                                            <span></span> aktif
                                                        </label>
                                                        <textarea name="Nilai_1[]" class="form-control summernote_osin">{{ $data['nilai_1'] }}</textarea>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="aktif2[{{$index}}]" value="0">
                                                        <label class="check">
                                                            <input type="checkbox" class="icheckbox" name="aktif2[{{$index}}]" value="1" {{ isset($data['aktif2']) && $data['aktif2'] == 1 ? 'checked' : '' }}>
                                                            <span></span> aktif
                                                        </label>
                                                        <textarea name="Nilai_2[]" class="form-control summernote_osin">{{ $data['nilai_2'] }}</textarea>
                                                    </td>
                                                    <td>
                                                        <input type="hidden" name="aktif3[{{$index}}]" value="0">
                                                        <label class="check">
                                                            <input type="checkbox" class="icheckbox" name="aktif3[{{$index}}]" value="1" {{ isset($data['aktif3']) && $data['aktif3'] == 1 ? 'checked' : '' }}>
                                                            <span></span> aktif
                                                        </label>
                                                        <textarea name="Nilai_3[]" class="form-control summernote_osin">{{ $data['nilai_3'] }}</textarea>
                                                    </td>
                                                    <td>
                                                        <input type="text" name="bobot[{{$index}}]" value="{{$data['bobot']}}">
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                                <div class="panel-footer">

                                    <a  class="btn btn-default" href="{{ route('admin.templates.index') }}">Kembali</a>
                                    <button class="btn btn-primary" type="submit">Submit</button>
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
<script type="text/javascript" src="{{ asset('js/plugins/summernote/summernote-lite.min.js')}}"></script>
<script>
    $(".summernote_osin").summernote({height: 200, focus: true,
                                                  toolbar: [
                                                      ['style', ['bold', 'italic', 'underline', 'clear']],
                                                      ['font', ['fontsize']],
                                                      ['fontstyle', ['fontname']],
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
</script>
<script>
   // Centang semua
   $('#checkAllAktif').on('click', function() {
            $('.icheckbox').iCheck('check');
        });

        // Hapus centang semua
        $('#uncheckAllAktif').on('click', function() {
            $('.icheckbox').iCheck('uncheck');
        });
</script>
@endsection
