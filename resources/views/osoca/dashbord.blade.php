@extends('layouts.cbs')

@section('css')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
<link rel="stylesheet" href="{{ asset('css/toastr/toastr.min.css') }}" />

@endsection

@section('judul')
<div class="col-xs-4 text-center">
    <strong>SELAMAT DATANG DI {{strtoupper( $osodata['ujian']->name) }} {{ strtoupper($osodata['ujian']->ta) }}</strong><br>
    <small>Tanggal : {{ tgl_indo($osodata['ujian']->tgl_ujian) }}</small>
</div>
@endsection

@section('penguji')

            <a class="dropdown-toggle" href="#"  data-toggle="dropdown" >
              <span><img src="{{ asset('img/mduser.jpg')  }}" alt="avatar" class="logo" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;"></span>

            </a>
@endsection

@section('mhs')
<div class="col-md-8">
    <div style="max-height: 340px; overflow-y: auto;">
    <table class="table table-borderless">
        <thead>
            <tr>

                <th width="400" style="text-align: center">Kompetensi Yang Dinilai</th>
                <th width="100">Bobot</th>
                <th width="100">Nilai</th>
                <th width="100">Aksi</th>

            </tr>
        </thead>
        <tbody>

            @foreach ($rubrik as $index => $data)
            <tr id="trow_{{$loop->iteration}}">
                <td><strong>{{$data['name']}}</strong>
                </td>
                <td >
                    <div id="bobot{{$data['id']}}" style="display: none;">{{$data['bobot']}}</div>
                </td>
                <td id="nilaiRubrik{{$data['id']}}">
                    --
                </td>
                <td>
                   <button  class="btn btn-md btn-success" data-toggle="modal" data-target="#modalPenilaian{{$data['id']}}"><i class="fa fa-pencil"></i> BERI NILAI</button>
                </td>


            </tr>
            @endforeach

            <tr><td></td>
                <td></td>
                <td id="feed"></td>
                <td><button href="#" class="btn btn-md btn-warning"  data-toggle="modal" data-target="#modalFeedback">Feedback</button></td>
            </tr>
        </tbody>
    </table>
    </div>
</div>
@endsection

@section('info-penguji')
<div class="card">
    <div class="row">
        <div class="col-xs-4 text-center">
                    <img src="{{ asset('img/mduser.jpg')}}" alt="avatar" class="logo" style="height: 80px; border-radius: 10%; object-fit: cover;">
        </div>
        <div class="col-xs-8">
            <h5 style="margin-top:0;"><strong>{{ $osodata['station']->name}} - {{$template->judul_station}}</strong></h5>
            <p style="margin: 0;">Penguji: <strong>{{ $osodata['station']->nama_penguji }}</strong></p>
            <p class="text-muted" style="margin: 5px 0;">{{ $osodata['mhs']->count()}} Peserta</p>
        </div>
    </div>
</div>
@endsection

@section('info-mhs')
<div class="card">
    <div class="row">

      <div class="col-xs-4 text-center">
        @if(is_null($peserta->avatar))
                    <img src="{{ asset('img/nouserr.jpg')}}" alt="avatar" class="logo" style="height: 80px; border-radius: 10%; object-fit: cover;">
        @else
                    <img src="https://cbs-feed.flarology.my.id/f/{{ $peserta->qrpeserta }}/{{ $peserta->avatar }}" alt="avatar" class="logo" style="height: 80px; border-radius: 10%; object-fit: cover;">
         @endif
                </div>
        <div class="col-xs-8">

            <h5 style="margin-top:0;">Nama :<strong> {{$peserta->name}}</strong></h5>
            <p style="margin: 0;">Npm: <strong>{{ $peserta->npm}}</strong></p>
            <p class="text-muted" style="margin: 5px 0;"> template  : <strong>{{ session('current') ?? "--" }}</strong> </p>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-4 text-center">




        </div>

        <div class="col-xs-8 "><button class="btn btn-warning btn-sm  pull-right" data-toggle="modal" data-target="#modalRekap">@if($pol) SELESAIKAN ROTASI <i class="fa  fa-arrow-right"></i>  @else MAHASISWA SELANJUTNYA <i class="fa  fa-arrow-right"></i> @endif</button></div>
    </div>
</div>

@endsection

@section('detail-soal')
<div class="card">
    <div>
        <a href="{{ route('osoca.template') }}" class="btn btn-primary" target="_blank" rel="noopener noreferrer">LIHAT DETAIL SOAL</a>
    </div>

    <hr>
    <div class="panel-body">
                        <div class="table-responsive">
                                        <table class="table ">
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
                                                    <td class="text-center">3 .</td>
                                                    <td>Skenario Klinik</td>
                                                    <td>
                                                         {!!$template->soal !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">4 .</td>
                                                    <td>Tugas</td>
                                                    <td>
                                                         {!! $template->tugas_mhs !!}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center" rowspan="2">5 .</td>
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

                                                </tr>
                                                @endforeach



                                            </tbody>
                                        </table>

                                    </div>

    </div>
</div>
@endsection

@section('modal')
{{-- modal rekap --}}
<div class="modal fade" id="modalRekap" tabindex="-1" role="dialog" aria-labelledby="modalRekapLabel">
    <div class="modal-dialog" style="width: 90%; max-width: 1000px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"> Pastikan semua butir penilaian telah diisi, Apakah Anda yakin dengan nilai ini?</h4>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th><strong>Kompetensi Yang Dinilai</strong></th>
                <th><strong>Bobot</strong></th>
                <th><strong>Nilai</strong></th>
              </tr>
            </thead>
            <tbody>
                @foreach ($rubrik as $index => $data)
                <tr id="trow_{{$loop->iteration}}">
                    <td><strong>{{$data['name']}}</strong>
                    </td>
                    <td >
                        <div id="mbobot{{$data['id']}}" style="display: none;">{{$data['bobot']}}</div>
                    </td>
                    <td id="mnilaiRubrik{{$data['id']}}">
                        --
                    </td>

                </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">


          <form id="submitPenilaianForm" method="POST" action="{{ route('osoca.penilaian.store') }}" >
            @csrf
            <input type="hidden" name="penilaian" id="penilaianHiddenInput">
            <input type="hidden" name="feedback" id="feedbackHiddenInput">
            <input type="hidden" name="next" value="{{ session('next') }}">
            <input type="hidden" name="ujian_id" value="{{ session('Osoca') }}">
            <input type="hidden" name="peserta_id" value="{{ $peserta->id }}">
            <input type="hidden" name="template_id" value="{{ $template->id }}">
            <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
                <button type="submit" class="btn btn-success">YAKIN</button>
        </form>


        </div>
      </div>
    </div>
  </div>
{{-- modal rekap end --}}
{{-- modal penilaian --}}
@foreach ($rubrik as $index => $data)
<div class="modal fade" id="modalPenilaian{{$data['id']}}" tabindex="-1" role="dialog" aria-labelledby="modalPenilaian{{$data['id']}}Label">
    <div class="modal-dialog" style="width: 90%; max-width: 1000px;">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Berikan Nilai - {{$data['name']}}</h4>
        </div>
        <div class="modal-body">
            <form id="Penilaian{{$data['id']}}">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th><strong>Pilihan</strong></th>
                <th><strong>Nilai</strong></th>
                <th><strong>Keterangan</strong></th>
              </tr>
            </thead>
            <tbody>
              <tr><td>
                <label class="btn btn-primary"><input type="radio" name="pilihan" value="3" data-id ="{{$data['id']}}"/> Pilih</label> </td><td style="text-align: center;"><strong>3</strong></td><td>{!! $data['nilai_3'] !!}</td></tr>
              <tr><td> <label class="btn btn-primary"><input type= "radio" name="pilihan" value="2" data-id ="{{$data['id']}}"/> Pilih</label> </td><td style="text-align: center;"><strong>2</strong></td><td>{!! $data['nilai_2'] !!}</td></tr>
              <tr><td> <label class="btn btn-primary"> <input type="radio" name="pilihan" value="1" data-id ="{{$data['id']}}"/> Pilih</label> </td><td style="text-align: center;"><strong>1</strong></td><td>{!! $data['nilai_1'] !!}</td></tr>
              <tr><td> <label class="btn btn-primary"> <input type="radio" name="pilihan" value="0" data-id ="{{$data['id']}}"/> Pilih</label> </td><td style="text-align: center;"><strong>0</strong></td><td>{!! $data['nilai_0'] !!}</td></tr>
            </tbody>

          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
          <button type="button" class="btn btn-success" form="Penilaian{{$data['id']}}">Simpan</button>
        </div>
      </div>
    </div>
  </div>
  @endforeach
 <!-- Modal global rating -->

   <!-- Modal No Peserta -->

   <div class="modal fade" id="modalNoPesert" tabindex="-1" role="dialog" aria-labelledby="modalNoPesertLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">

        <!-- Header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Peserta Tidak Hadir</h4>
        </div>

        <!-- Body -->
        <div class="modal-body">

            <h3>Apakah anda yakin Tidak ada peserta ? </h3>

        </div>

        <!-- Footer -->
        <div class="modal-footer">
            <form id="submitTidakHadir" method="POST" action="#" >
            </form>
            <button type="button" class="btn btn-default" data-dismiss="modal">TUTUP</button>
            <a href="{{ route('osoca.tolist')}}" class="btn btn-red btn-sm">YAKIN</a>
        </div>

      </div>
    </div>
  </div>
  {{-- modal feedback --}}
  <div class="modal fade" id="modalFeedback" tabindex="-1" role="dialog" aria-labelledby="modalFeedbackLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">

        <!-- Header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">FEEDBACK MAHASISWA</h4>
        </div>

        <!-- Body -->
        <div class="modal-body">
          <form id="FeedbackForm">
            <textarea class="form-control" id="feedback" rows="7" name="feedback">
Kelebihan :

Kekurangan :

Masukan:

            </textarea>
          </form>
        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">TUTUP</button>
          <button type="submit" class="btn btn-primary simpan-feedback" form="FeedbackForm">SIMPAN</button>
        </div>

      </div>
    </div>
  </div>
{{-- modal penilaian end --}}


  @endsection

@section('script')
<script type="text/javascript" src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}

<script type="text/javascript" src="{{ asset('js/osoca_ujian.js') }}"></script>



@endsection
