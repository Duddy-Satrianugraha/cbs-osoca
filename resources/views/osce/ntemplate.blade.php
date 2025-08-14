<!DOCTYPE html>
<html lang="id">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta charset="UTF-8">
  <title>{{ config('app.name', 'Arap') }}</title>

  <!-- Bootstrap 3.3.0 -->
  <link rel="stylesheet" type="text/css"  href="{{ asset('css/bootstrap/bootstrap.min.css')}}"/>
  <!-- Font Awesome 4.1.0 -->
  <link rel="stylesheet" type="text/css"  href="{{ asset('css/fontawesome/font-awesome.min.css')}}"/>

  <style>
    body {
      background-color: #f5f5f5;
    }

    .top-bar {
      background-color: #fff;
      border-bottom: 1px solid #ddd;
      padding: 10px 20px;
    }

    .top-bar .logo {
      height: 80px;
    }

    .logout-btn {
      margin-top: 5px;
    }

    .center-title {
      font-size: 18px;
      font-weight: bold;
      text-align: center;
      line-height: 40px;
    }

    .main-card {
      background-color: #fff;
      padding: 30px;
      border: 1px solid #ddd;
      box-shadow: 0 2px 8px rgba(0,0,0,0.05);
      margin-top: 30px;
    }

    .refresh-btn {
      margin-top: 10px;
    }
  </style>
</head>
<body>

  <!-- HEADER -->
  <div class="top-bar clearfix">
    <div class="pull-left">
        <img src="/img/logo.png" alt="Logo Institusi" class="logo" style="height: 40px;">
    </div>

    <div class="pull-left" style="width: 90%; text-align: center;">
        <h4 style="margin: 0; line-height: 40px; font-weight: bold;">OSCE {{$ujian->name}}</h4>
    </div>

    <div class="pull-right" style="margin-top: 5px;">

    </div>
    </div>

  <!-- ISI -->
  <div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h2>Laboratorium Keterampilan Klinik Fakultas Kedokteran UGJ</h2>
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
                                    <td>Nomor Station</td>
                                    <td>{{$template->nomor_station}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">2 .</td>
                                    <td>Judul Station</td>
                                    <td>{{$template->judul_station}}</td>
                                </tr>
                                <tr>
                                    <td class="text-center">3 .</td>
                                    <td>Alokasi Waktu</td>
                                    <td>15 menit</td>
                                </tr>
                                <tr>
                                    <td class="text-center">4 .</td>
                                    <td>Tingkat Kemampuan Kasus yang Diujikan</td>
                                    <td><strong>Tingkat Kemampuan SKDI: {{ $template->tingkat_kemampuan_kasus }} <br>
                                        {{$template->nama_tkk}}</strong>
                                        </td>
                                </tr>
                                <tr>
                                    <td class="text-center">5 .</td>
                                    <td>Kompetensi Diujikan</td>
                                    <td>@foreach($template->nama_kyds as $data)

                                        <strong>{{$data}}</strong><br/>
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-center">6 .</td>
                                    <td>Kategori Sistem Tubuh</td>
                                    <td>
                                        <strong>{{$template->nama_kategori_sistem_tubuh}}</strong></td>
                                </tr>
                                <tr>
                                    <td class="text-center">7 .</td>
                                    <td>Instruksi Peserta Ujian</td>
                                    <td>
                                        <strong> Skenario Klinik</strong><br/>
                                         {!!$template->ipu_skenario_klinik !!}
                                         <hr/>
                                         <strong> Tugas</strong><br/>
                                         {!! $template->ipu_peserta_tugas !!}
                                    </td>
                                </tr>
                                @php
                                $kyd = explode(',', $template->komptensi_yang_diujikan);

                            @endphp
                                <tr>
                                    <td class="text-center" rowspan="2">8 .</td>
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
                                    <td class="text-center">9 .</td>
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
                <div class="panel-footer">


                </div>



            </div>
            </form>
        </div>

    </div>
  </div>

  <!-- JS -->
  <script type="text/javascript" src="{{ asset('js/plugins/jquery/jquery.min.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap.min.js') }}"></script>
</body>
</html>
