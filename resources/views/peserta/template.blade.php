@extends('layouts.cbs_temp')

@section('css')

{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css" integrity="sha512-6S2HWzVFxruDlZxI3sXOZZ4/eJ8AcxkQH1+JjSe/ONCEqR9L4Ysq5JdT5ipqtzU7WHalNwzwBv+iE51gNHJNqQ==" crossorigin="anonymous" referrerpolicy="no-referrer" /> --}}
<link rel="stylesheet" href="{{ asset('css/toastr/toastr.min.css') }}" />

@endsection

@section('judul')
<div class="col-xs-4 text-center">
    <strong>SELAMAT DATANG DI {{strtoupper( $ujian->name) }} {{ strtoupper($ujian->ta) }}</strong><br>
    <small>Tanggal : {{ tgl_indo($ujian->tgl_ujian) }}</small>
</div>
@endsection

@section('penguji')

            <a class="dropdown-toggle" href="#"  data-toggle="dropdown" >
              <span><img src="{{ asset('img/mduser.jpg')  }}" alt="avatar" class="logo" style="height: 40px; width: 40px; border-radius: 50%; object-fit: cover;"></span>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li><a href="{{ route('peserta.tolist')}}">Logout</a></li>
                </ul>
            </a>
@endsection



@section('detail-soal')
<div class="card">
    <a href="{{ route('peserta.tolist')}}" class="btn btn-lg btn-danger">Logout</a>
    <div class="pull-right" style="font-size:20px; font-weight:bold;">
    <span id="timer">12:00</span>
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
                                                    <td>Nomor kasus</td>
                                                    <td>{{$template->nomor_station}}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">2 .</td>
                                                    <td>Skenario Klinik</td>
                                                    <td>
                                                         {!!$template->soal !!}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-center">3 .</td>
                                                    <td>Tugas</td>
                                                    <td>
                                                         {!! $template->tugas_mhs !!}
                                                    </td>
                                                </tr>



                                            </tbody>
                                        </table>
                                        <hr/>


                                    </div>

    </div>
</div>
@endsection



@section('script')
<script type="text/javascript">
// durasi 12 menit dalam detik
    let timeLeft = 10 * 60;

    function updateTimer() {
        let minutes = Math.floor(timeLeft / 60);
        let seconds = timeLeft % 60;

        // format supaya 2 digit (misalnya 09:05)
        if (seconds < 10) seconds = "0" + seconds;
        if (minutes < 10) minutes = "0" + minutes;

        document.getElementById("timer").innerText = minutes + ":" + seconds;

        if (timeLeft <= 0) {
            clearInterval(timerInterval);
            window.location.href = "/peserta/tolist"; // URL redirect
        }

        timeLeft -= 1;
    }

    // jalankan pertama kali langsung update
    updateTimer();

    // lalu update setiap detik
    let timerInterval = setInterval(updateTimer, 1000);
</script>
@endsection
