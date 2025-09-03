@extends('layouts.cbs_temp')

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
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{ route('osoca.tolist')}}">Logout</a></li>
                </ul>
            </a>
@endsection



@section('detail-soal')
<div class="card">

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
                                                    <td class="text-center">7 .</td>
                                                    <td>Skenario Klinik</td>
                                                    <td>
                                                         {!!$template->soal !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">7 .</td>
                                                    <td>Tugas</td>
                                                    <td>
                                                         {!! $template->tugas_mhs !!}
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td class="text-center" rowspan="2">8 .</td>
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



@section('script')

@endsection
