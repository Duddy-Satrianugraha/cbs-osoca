@extends('layouts.cbs')

@section('css')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
<link rel="stylesheet" href="{{ asset('css/toastr/toastr.min.css') }}" />

@endsection

@section('judul')
<div class="col-xs-4 text-center">
    <strong>SELAMAT DATANG DI UJIAN {{ strtoupper($ujian->name) }} </strong><br>
    <small>{{ $sesi->name}}, {{$lokasi->nama}}, {{$rotasi->nama}}</small>
</div>
@endsection

@section('penguji')

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @if(is_null($penguji->avatar))
                    <span><img src="{{ asset('img/mduser.jpg')  }}" alt="avatar" class="logo" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;"></span>
                        @else
                        <span><img src="{{ $penguji->avatar }}" alt="avatar" class="logo" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;"></span>
                        @endif
                </a>
@endsection

@section('mhs')
<div class="col-md-8">
    @if(!session()->has('mhs_id'))
    <h5><strong>Mahasiswa Selanjutnya :</strong> {{is_null($next_peserta) ?  "tidak ada peserta" : $next_peserta->name }} - <strong>{{ is_null($next_peserta) ? " Silakahan klik tombol TIDAK HADIR" : $next_peserta->username  }}</strong></h5>
    <div style="max-height: 300px; overflow-y: auto;">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Nomor Ujian</th>
                    <th>Urutan</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @php($z = 1)
                @foreach($list_peserta as $index => $data)
                        <tr @if(false <> $data['status']) style="display:none;" @endif
                        ><td>{{ $z }}</td><td> {{$data['nama']}}</td><td>{{$data["username"]}}</td><td>{{$data['id']}}</td><td>
                            @if($data['status'])
                            <strong>sudah</strong>
                            @else

                            <strong>belum</strong>
                            @endif

                        </td></tr>
                        @if(is_null($data['status'])) @php($z++) @endif

                @endforeach

            </tbody>
        </table>
    </div>
    @else
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
                <td><strong>{{$data['komp']}}</strong>
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
                <td id="globalRating"></td>
                <td><button href="#" class="btn btn-md btn-info" data-toggle="modal" data-target="#modalGlobalRating"> Global Rating</button></td>
            </tr>
            <tr><td></td>
                <td></td>
                <td id="feed"></td>
                <td><button href="#" class="btn btn-md btn-warning"  data-toggle="modal" data-target="#modalFeedback">Feedback</button></td>
            </tr>
        </tbody>
    </table>
    </div>
    @endif
</div>
@endsection

@section('info-penguji')
<div class="card">
    <div class="row">
        <div class="col-xs-4 text-center">
            @if(is_null($penguji->avatar))
                    <img src="{{ asset('img/mduser.jpg')}}" alt="avatar" class="logo" style="height: 80px; border-radius: 10%; object-fit: cover;">
                    @else
                        <img src="{{ $penguji->avatar }}" alt="avatar" class="logo" style="height: 80px; border-radius: 10%; object-fit: cover;">
                        @endif

        </div>
        <div class="col-xs-8">
            <h5 style="margin-top:0;"><strong>{{$station->name}} - {{$template->judul_station}}</strong></h5>
            <p style="margin: 0;">Penguji: <strong>{{ $penguji->name}}</strong></p>
            <p class="text-muted" style="margin: 5px 0;">{{ $sesi->jml_station }} Peserta</p>
            @if(session()->has('pasien_name'))
            <p style="margin: 0;">PS: <strong>{{ session('pasien_name')}}</strong></p>
            @else
                @if(!session()->has('mhs_id'))
                <button class="btn btn-xs btn-primary pull-right" data-toggle="modal" data-target="#modalPasien">PASIEN</button>
                @endif

            @endif


        </div>
    </div>
</div>
@endsection

@section('info-mhs')
<div class="card">
    @if(!session()->has('mhs_id'))
    <div class="row">
        <div class="col-xs-12 text-center"><strong>Arahkan QR Code Mahasiswa ke kamera</strong></div>

    </div>
    @endif
    <div class="row">
        <div class="col-xs-4 text-center">
            @if(!session()->has('mhs_id'))
            <div class="card" style="width: 100%; max-width: 500px; height: 110px; margin: 0 auto; margin-bottom: 10px; padding: 2px;">
                <video id="preview" style="width: 100%; height: 100%; object-fit: cover;"></video>
            </div>
            <form action="{{ route('osce.mhs') }}" method="post" class="form-horizontal" id="form-scan">
                @csrf
                <input type="hidden" name="mhs_slug" id="soal-slug" value="">
                <input type="hidden" name="peserta_slug"  value="{{is_null($next_peserta) ?  "" : $next_peserta->slug }}">
                <input type="hidden" name="pendaftaran_id"  value="{{$next_pendaftaran }}">
            </form>
            @else
                @if($mhs)
                <img src="{{ $mhs->avatar ?? asset('user.jpg')}}" alt="{{$mhs->name ?? "avatar"}}" class="logo" style="height: 80px; border-radius: 10%; object-fit: cover;">
                @else
                <img src="{{ asset('img/user.jpg')}}" alt="avatar" class="logo" style="height: 80px; border-radius: 10%; object-fit: cover;">

                    @endif
            @endif
        </div>
        <div class="col-xs-8">
            @if(!session()->has('mhs_id'))
            <p class="text-muted" style="margin: 5px 0;"> Nomor urut selanjutnya : <strong>{{ $curent_urutan }}</strong> </p>
            @else
            <h5 style="margin-top:0;">Nama :<strong>{{ $mhs->name ?? "--" }}</strong></h5>
            <p style="margin: 0;">Npm: <strong>{{ $mhs->username ?? "--" }}</strong></p>
            <p class="text-muted" style="margin: 5px 0;"> Urutan : <strong>{{ $curent_urutan }}</strong> </p>
                @endif
        </div>
    </div>
    @if(!session()->has('mhs_id'))
    <div class="row">
        <div class="col-xs-12 text-center">
            <button data-toggle="modal" data-target="#modalNoPesert" class="btn btn-red btn-sm btn-block">TIDAK HADIR <i class="fa fa-sign-out"></i></button>

            </div>

    </div>
    @else
    <div class="row">
        <div class="col-xs-4 text-center">

                <button  class="btn btn-red btn-sm btn-block" data-toggle="modal" data-target="#modalNoPesert">TIDAK HADIR <i class="fa fa-sign-out"></i></button>


        </div>

        <div class="col-xs-8 "><button class="btn btn-warning btn-sm  pull-right" data-toggle="modal" data-target="#modalRekap">@if($pol) SELESAIKAN ROTASI <i class="fa  fa-arrow-right"></i>  @else MAHASISWA SELANJUTNYA <i class="fa  fa-arrow-right"></i> @endif</button></div>
    </div>
    @endif
</div>

@endsection

@section('detail-soal')
<div class="card">
    <div>
        <a href="{{ route('osce.template') }}" class="btn btn-primary" target="_blank" rel="noopener noreferrer">LIHAT DETAIL SOAL</a>
 @if(!is_null($template->penunjang))
    <button id="btnTogglePenunjang" class="btn btn-warning">HASIL PEMERIKSAAN TIDAK TAMPIL</button>
    @endif
    </div>

    <hr>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-borderless">

                <tbody>
                    <tr>

                        <td width="200">Kategori Sistem Tubuh</td>
                        <td>
                            <strong>{{$template->nama_kategori_sistem_tubuh}}</strong></td>
                    </tr>
                    <tr>

                        <td>Judul Station</td>
                        <td>{{$template->judul_station}}</td>
                    </tr>
                    <tr>

                        <td>Instruksi Peserta Ujian</td>
                        <td>
                            <strong> Skenario Klinik</strong><br/>
                             {!!$template->ipu_skenario_klinik !!}
                             <hr/>
                             <strong> Tugas</strong><br/>
                             {!! $template->ipu_peserta_tugas !!}
                        </td>
                    </tr>
                    @php($kyd = explode(',', $template->komptensi_yang_diujikan))
                    <tr>

                        <td rowspan="2">Instruksi Penguji</td>
                        <td>Instruksi Umum <br/>
                            {!! $template->ip_instruksi_umum !!}

                        </td>
                    </tr>
                    <tr>
                        <td>Instruksi Khusus<br/>
                            @if(in_array('1', $kyd))
                            {!! $template->ip_ik_anamnesis !!}
                            <hr/>
                            @endif
                            @if(in_array('2', $kyd))
                            {!! $template->ip_ik_p_fisik !!}
                            <hr/>
                            @endif
                            @if(in_array('3', $kyd))
                            {!! $template->ip_ik_ttv !!}
                            <hr/>
                            @endif
                            @if(in_array('4', $kyd))
                            {!! $template->ip_ik_p_penunjang !!}
                            <hr/>
                            @endif
                            @if(in_array('5', $kyd))
                            {!! $template->ip_ik_diagnosis !!}
                            <hr/>
                            @endif
                            @if(in_array('6', $kyd))
                            {!! $template->ip_ik_non_farmakoterapi !!}
                            <hr/>
                            @endif
                            @if(in_array('7', $kyd))
                            {!! $template->ip_ik_farmakoterapi !!}
                            <hr/>
                            @endif
                            @if(in_array('8', $kyd))
                            {!! $template->ip_ik_kom_edu !!}
                            <hr/>
                            @endif
                            @if(in_array('9', $kyd))
                            {!! $template->ip_ik_perilaku !!}
                            @endif
                        </td>
                    </tr>
                    <tr>

                        <td>Instruksi Pasien Standar </td>
                        <td>
                            <strong> Identitas Pasien</strong><br/>
                            {!! $template->ips_identitas !!}
                            <hr/>
                            <strong> Riwayat Penyakit Sekarang</strong><br/>
                            {!! $template->ips_rp_sekarang !!}
                            <hr/>
                            <strong> Riwayat Penyakit Terdahulu</strong><br/>
                            {!! $template->ips_rp_dahulu !!}
                            <hr/>
                            <strong> Riwayat Penyakit Keluarga</strong><br/>
                            {!! $template->ips_rp_keluarga !!}
                            <hr/>
                            <strong> Riwayat Pribadi/Sosial</strong><br/>
                            {!! $template->ips_r_pribadi !!}
                            <hr/>
                            <strong> Pertanyaan Wajib</strong><br/>
                            {!! $template->ips_pertanyaan_wajib !!}
                            <hr/>
                            <strong> Peran Wajib</strong><br/>
                            {!! $template->ips_peran_wajib !!}
                            <hr/>
                            <strong> Molase</strong><br/>
                            {!! $template->ips_molase !!}

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

                    </tr>
                </thead>
                <tbody>

                    @foreach ($rubrik as $index => $data)
                    <tr id="trow_{{$loop->iteration}}">
                        <td class="text-center">{{$loop->iteration}}</td>
                        <td><strong>{{$data['komp']}}</strong>
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
                    <td><strong>{{$data['komp']}}</strong>
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
              <tr>
                <td colspan="2"><strong>Global Rating</strong></td>
                <td><strong id="mglobalRating"></strong></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">


          <form id="submitPenilaianForm" method="POST" action="{{ route('osce.penilaian.store') }}" >
            @csrf
            <input type="hidden" name="penilaian" id="penilaianHiddenInput">
            <input type="hidden" name="feedback" id="feedbackHiddenInput">
            <input type="hidden" name="globalRating" id="globalRatingHiddenInput">
            <input type="hidden" name="next" value="{{ session('current_peserta') }}">
            <input type="hidden" name="peserta_id" value="{{ $curent_user->id }}">
            <input type="hidden" name="limit" value="{{ $pol}}">
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
          <h4 class="modal-title">Berikan Nilai - {{$data['komp']}}</h4>
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
              <tr><td><input type="radio" name="pilihan" value="3" data-id ="{{$data['id']}}"/> </td><td>3</td><td>{!! $data['nilai_3'] !!}</td></tr>
              <tr><td><input type="radio" name="pilihan" value="2" data-id ="{{$data['id']}}"/> </td><td>2</td><td>{!! $data['nilai_2'] !!}</td></tr>
              <tr><td><input type="radio" name="pilihan" value="1" data-id ="{{$data['id']}}"/> </td><td>1</td><td>{!! $data['nilai_1'] !!}</td></tr>
              <tr><td><input type="radio" name="pilihan" value="0" data-id ="{{$data['id']}}"/> </td><td>0</td><td>{!! $data['nilai_0'] !!}</td></tr>
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
<div class="modal fade" id="modalGlobalRating" tabindex="-1" role="dialog" aria-labelledby="modalGlobalRatingLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">

        <!-- Header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">GLOBAL RATING SCALE</h4>
        </div>

        <!-- Body -->
        <div class="modal-body">
          <form id="globalRatingForm">
            <div class="radio">
              <label><input type="radio" name="rating" value="1"> Tidak Lulus</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="rating" value="2"> Borderline</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="rating" value="3"> Lulus</label>
            </div>
            <div class="radio">
              <label><input type="radio" name="rating" value="4"> Superior</label>
            </div>
          </form>
        </div>

        <!-- Footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">TUTUP</button>
          <button type="submit" class="btn btn-primary" form="globalRatingForm">SIMPAN</button>
        </div>

      </div>
    </div>
  </div>
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
            @if(!is_null($next_peserta))

            <h5>Apakah anda yakin {{$next_peserta->name}} dengan NPM {{ $next_peserta->username }} Tidak Hadir ?</h5>
            @else
            <h3>Apakah anda yakin Tidak ada peserta ? </h3>
            @endif
        </div>

        <!-- Footer -->
        <div class="modal-footer">
            <form id="submitTidakHadir" method="POST" action="{{ route('osce.tidak.hadir') }}" >
                @csrf
                <input type="hidden" name="next" value="{{ session('current_peserta') }}">
                <input type="hidden" name="peserta_id" value="{{ $curent_user->id }}">
                <input type="hidden" name="limit" value="{{ $pol}}">
                <button type="button" class="btn btn-default" data-dismiss="modal">TUTUP</button>
                <button type="submit" class="btn btn-red btn-sm">YAKIN</button>
            </form>
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
 <!-- Modal pasien -->
 <div class="modal fade" id="modalPasien" tabindex="-1" role="dialog" aria-labelledby="modalPasienLabel">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">

        <!-- Header -->
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Pasien Simulasi</h4>
        </div>

        <!-- Body -->
        <div class="modal-body">
            <p>Arahkan QR Code Pasien ke kamera</p>
            <div class="card" style="width: 100%; max-width: 500px; height: 240px; margin: 0 auto; margin-bottom: 10px; padding: 2px;">
                <video id="mpreview" style="width: 100%; height: 100%; object-fit: cover;"></video>
            </div>
            <form action="{{ route('osce.pasien') }}" method="post" class="form-horizontal" id="form-scanx">
                @csrf
                <input type="hidden" name="pasien_slug" id="pasien-slug" value="">

            </form>
        </div>

        <!-- Footer -->


      </div>
    </div>
  </div>
  @endsection

@section('script')
@if(!session()->has('mhs_id')) {{-- tambahkan ! jika mau di pake  jika mhs_id tidak ada --}}
<script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/osce_scan.js') }}"></script>
@endif
<script type="text/javascript" src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js" integrity="sha512-lbwH47l/tPXJYG9AcFNoJaTMhGvYWhVM9YI43CT+uteTRRaiLCui8snIgyAN8XWgNjNhCqlAUdzZptso6OCoFQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script>
    let dataurl = '{{ route("osce.showing.penunjang") }}';
    </script>
<script type="text/javascript" src="{{ asset('js/osce_ujian.js') }}"></script>



@endsection
