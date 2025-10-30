<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Penguji OSOCA</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>
        body {
            background-color: #f8f9fa;
        }

        .top-bar {
            background-color: #ffffff;
            border-bottom: 1px solid #dee2e6;
            padding: 10px 20px;
        }

        .top-bar .logo {
            font-weight: bold;
            font-size: 1.2rem;
            color: #333;
        }

        .top-bar .center-info {
            text-align: center;
            font-size: 14px;
        }

        .top-bar .user-info {
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .top-bar .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 10px;
        }

        .status-belum {
            color: gray;
            font-weight: bold;
        }

        .btn-pasien {
            font-size: 0.75rem;
            padding: 4px 8px;
        }

        .card-profile img {
            width: 100%;
            max-height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .btn-tidak-hadir {
            background-color: #ff4d4f;
            color: white;
        }

        .detail-soal {
            font-size: 0.95rem;
            line-height: 1.5;
        }

        .bg-orange {
            background-color: #fd7e14;
            color: white;
        }

        .dropdown-menu-right {
            right: 0;
            left: auto;
        }

        @media (max-width: 768px) {
            .top-bar .center-info {
                font-size: 12px;
            }
        }
    </style>
    <link rel="stylesheet" href="{{ asset('css/toastr/toastr.min.css') }}" />
</head>
<body>

<!-- HEADER -->
<div class="top-bar container-fluid d-flex justify-content-between align-items-center">
    <div class="logo">UJIAN OSOCA</div>
    <div class="center-info flex-grow-1 text-center">
        <strong>SELAMAT DATANG DI {{strtoupper( $osodata['ujian']->name) }} {{ strtoupper($osodata['ujian']->ta) }}</strong><br>
       Tanggal : {{ tgl_indo($osodata['ujian']->tgl_ujian) }}

    </div>
    <div class="user-info">
        <div class="dropdown">
            <a class="dropdown-toggle text-dark" href="#" role="button" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ $osodata['station']->nama_penguji }}
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="{{ route('osoca.tolist')}}">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- ISI HALAMAN -->
<div class="container-fluid mt-3">
    <div class="row">
        <!-- Tabel Mahasiswa -->
        <div class="col-lg-8 col-md-7 mb-4">
            <h6>Rubrik Soal {{$template->judul_station}}</h6>



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

        <!-- Info Penguji -->
        <div class="col-lg-4 col-md-5 mb-4">
            <!-- Card 1: Info Station dengan Foto di Kiri -->
            <div class="card mb-3">
                <div class="card-body d-flex">


                    <!-- Informasi Station + Tombol -->
                    <div class="flex-grow-1 w-100">
                        <!-- Baris atas: Judul + tombol -->
                        <div class="d-flex justify-content-between align-items-start mb-1">
                            <h6 class="text-uppercase font-weight-bold mb-0">STATION: {{ $osodata['station']->name}} - {{$template->judul_station}}</h6>
                        </div>

                        <!-- Detail info -->
                        <p class="mb-1">Penguji: <strong>{{ $osodata['station']->nama_penguji }}</strong></p>
                        <p class="text-muted mb-0">{{ $osodata['mhs']->count()}} Peserta</p>
                    </div>
                </div>
            </div>


            <!-- Card 2: Kamera dan Aksi -->
            <div class="card">
                <div class="card-body">
                    <!-- Baris atas: Teks kiri dan kontrol kanan -->
                    <div class="d-flex justify-content-between align-items-start mb-3">
                        <p class="mb-0 font-weight-bold">Peserta Ujian:</p>
                        <div class="d-flex align-items-center">

                        </div>
                    </div>

                    <!-- Gambar mahasiswa -->
                    <div class="text-center mb-3">
                        <H4 class="text-center">
                            {{$peserta->name}} <br>
                            {{ $peserta->npm}} <br>
                        </H4>
                    </div>

                    <!-- Nomor urut dan tombol -->
                    <div class="text-center">
                        <p class="mb-2">Nomor urut selanjutnya: <strong>2</strong></p>
                        <button class="btn btn-danger btn-block">TIDAK HADIR</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Detail Soal -->
    <div class="card mt-3">
        <div class="card-body">
            <div class="mb-3">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalPenilaian">LIHAT DETAIL SOAL</button>

            </div>
            <div class="detail-soal">
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
    </div>
</div>

<!-- Modal Penilaian -->
<div class="modal fade" id="modalPenilaian" tabindex="-1" role="dialog" aria-labelledby="modalPenilaianLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Apakah Anda yakin dengan nilai ini?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Tutup">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <table class="table table-bordered">
            <thead class="thead-light">
              <tr>
                <th>Kompetensi Yang Dinilai</th>
                <th>Bobot</th>
                <th>Nilai</th>
              </tr>
            </thead>
            <tbody>
              <tr><td>Anamnesis</td><td>4</td><td>3</td></tr>
              <tr><td>Pemeriksaan Fisik/Psikiatri</td><td>3</td><td>3</td></tr>
              <tr><td>Interpretasi Data/Kemampuan Prosedural Pemeriksaan Penunjang</td><td>3</td><td>3</td></tr>
              <tr><td>Penegakan Diagnosis dan Diagnosis Banding</td><td>3</td><td>3</td></tr>
              <tr><td>Tatalaksana Farmakoterapi</td><td>3</td><td>3</td></tr>
              <tr><td>Komunikasi dan Edukasi Pasien</td><td>2</td><td>3</td></tr>
              <tr><td>Perilaku Profesional</td><td>1</td><td>3</td></tr>
            </tbody>
            <tfoot>
              <tr>
                <td colspan="2"><strong>Global Rating</strong></td>
                <td><strong>Lulus</strong></td>
              </tr>
            </tfoot>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">BATAL</button>
          <button type="button" class="btn btn-success">YAKIN</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal: penilaiann -->
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
  <!-- Modal: feedback -->
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


<!-- Bootstrap JS + FontAwesome (untuk ikon tanda tanya) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://kit.fontawesome.com/a2e0e6b415.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="{{ asset('js/plugins/toastr/toastr.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/osce_ujian.js') }}"></script>
</body>
</html>
