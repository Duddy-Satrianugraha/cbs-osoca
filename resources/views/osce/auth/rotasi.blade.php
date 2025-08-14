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
            <div class="info-title">Info Station</div>
            <p><span class="info-label">Ujian:</span> {{$ujian->name}}</p>
            <p><span class="info-label">Sesi Ujian:</span> {{$sesi->name}}</p>
            <p><span class="info-label">Tanggal:</span> {{tgl_indo($sesi->tgl_ujian)}}</p>
            <p><span class="info-label">Lokasi:</span>  {{$lokasi->nama}}</p>
            <p><span class="info-label">Station:</span>  {{$station->name}} - {{$template->judul_station}}</p>
            @php $jml_rotasi =  $lokasi->rotations()->count();
                 $peserta =  $jml_rotasi * $sesi->jml_station;
                @endphp
            <p><span class="info-label">Jumlah Rotasi:</span> {{$jml_rotasi}} Rotasi</p>
            <p><span class="info-label">Total Peserta:</span> {{$peserta}} Peserta</p>
            <p><span class="info-label">Penguji:</span> {{ $penguji->name}} </p>

            <br><br><br><br><br>
            <a href="{{ route('osce.logout')}}" class="btn btn-bahaya">KELUAR</a>
        </div>

        <!-- Kanan: Panel Tab -->
        <!-- Panel Tab -->
        <div class="col-sm-6 tabs">
            <ul class="nav nav-tabs" role="tablist">
                @foreach($rotasi as $data)
                <li class="{{ $loop->first ? 'active' : '' }}">
                    <a href="#rotasi-{{$data->id}}" role="tab" data-toggle="tab">{{ $data->nama }}</a>
                </li>
                @endforeach
            </ul>

            <div class="tab-content" style="margin-top: 15px;">
                @foreach($rotasi as $datb)
                    @php
                    if(is_null($datb->status)){
                                $statr = null;
                            } else {
                            $statr = json_decode($datb->status, true);
                            }
                    $current = $station->urutan;
                    $statusValuer = is_array($statr) && isset($statr[$current]) ? true : false;
                    @endphp

                    <div class="tab-pane fade {{ $loop->first ? 'in active' : '' }}" id="rotasi-{{$datb->id}}">
                        <div class="clearfix">
                            <h4 class="pull-left" style="margin-top: 0;">Daftar Peserta</h4>
                            @if(!$statusValuer)
                            <a href="{{route('osce.ujian.rotasi', $datb->id)}}" class="btn btn-xs pull-right" style="background-color: #450163; color: white;">
                                <i class="fa fa-play"></i> Uji {{ $datb->nama }}
                            </a>
                            @else
                            <h5 class="pull-right" style="margin-top: 0;">Rotasi telah di uji</h5>
                            @endif
                        </div>
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Peserta</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($datb->pesertas as $index => $peserta)
                                    @php

                                    $mhs = $peserta->user; @endphp
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if(is_null($mhs))
                                                <em class="text-muted">Tidak ada peserta</em>
                                            @else
                                                {{ $mhs->name }} ({{ $mhs->username }})
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center text-muted">Tidak ada peserta</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>

                    </div>

                @endforeach
            </div>
        </div>


        <!--  akhri panel yab-->
      </div>
    </div>
  </div>


@endsection


@section('script')

@endsection
