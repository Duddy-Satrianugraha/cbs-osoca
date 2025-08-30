@extends('layouts.cbs_login')

@section('css')

@endsection

@section('content')
<div class="row">
    <div class="col-md-10 col-md-offset-1 card shadow-card"> 
        @include('includes.osin_alert')
      <div class="row">
        <!-- Kiri: Info Station -->
        <div class="col-sm-6">
            <div class="info-title">Data Peserta</div>
            <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Peserta</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                             
                              @foreach ($data['mhs'] as $datamhs)
                              <tr>
                                <td>{{ $datamhs->sesi }}</td>
                                <td>{{ $datamhs->name }}</td>
                                <td>@if($datamhs->status)
                                    <span class="label label-success">
                                        <i class="fa fa-check"></i> Telah diuji
                                    </span>
                                    @else
                                    <span class="label label-info">
                                        <i class="fa fa-times"></i> Belum Diuji
                                    </span>
                                    @endif
                                </td>
                              </tr>
                              @endforeach
                             
                             

                            </tbody>
                        </table>


        </div>

        <!-- Kanan: Panel Tab -->
        <!-- Panel Tab -->
        <!-- Panel Tab -->
            <div class="col-sm-6">
              <div class="info-title">UJIAN OSOCA {{$data['ujian']->name}}</div>
            
                <p><span class="info-label2">Station: {{$data['station']->name}} </span> </p>
                <p><span class="info-label2">Sesi: {{ session('current')}}</span> </p>
                <p><span class="info-label2">Penguji:  {{$data['station']->nama_penguji}}</span> </p>
                <div class="info-title">Silahkan Arahkan Qr Code Peserta Ujian</div>
                 <!-- hidden station_slug -->
                 <form action="{{ route('osoca.mhs.chek')}}" method="post" class="form-horizontal" id="form-scan">
                @csrf
               <input type="hidden" name="sesi-qr" id="sesi-qr"  value=""> 
                <div class="card" style="width: 100%; max-width: 500px; height: 300px; margin: 0 auto; margin-bottom: 20px; padding: 4px;">
                    <video id="preview" style="width: 100%; height: 100%; object-fit: cover;"></video>
                </div>

                </form>
                  <br>
            <a href="{{ route('osoca.logout')}}" class="btn btn-bahaya">KELUAR</a>

            </div>


        <!--  akhri panel yab-->

        <!--  akhri panel yab-->
      </div>
    </div>
  </div>


@endsection


@section('script')
<script type="text/javascript" src="{{ asset('js/instascan.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/osoca_mhs.js') }}"></script>

@endsection
