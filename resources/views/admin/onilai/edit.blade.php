@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.nilai.index')}}">Daftar Ujian</a></li>
    <li ><a href="{{ route('admin.nilai.show', $ujian->id)}}">Daftar Nilai</a></li>
        <li class="active">Edit nilai</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Edit {{ $peserta->name }}</h2>
</div>
@endsection
@section('content')

<!-- START WIDGETS -->
<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" action="{{ route('admin.nilai.update', $peserta->id) }}" method="POST" >
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Nilai Peserta</strong>Edit</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
            </div>
            <div class="panel-body form-group-separated">
                @method('put')
                    @csrf
                    <input type="hidden" name="peserta_id" value="{{ $peserta->id }}">
                    <input type="hidden" name="nilai_id" value="{{ $nilai->id ?? 0 }}">
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Nama</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                            <input type="text" class="form-control" value="{{ $peserta->name }}" readonly/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">NPM</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                            <input type="text" class="form-control" value="{{ $peserta->npm }}" readonly/>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Ujian</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-users"></span></span>
                            <input type="text" class="form-control" value="{{ $ujian->name }}" readonly/>
                        </div>
                    </div>
                </div>
                @php $i = 1;
                                                if(!is_null($nilai)){
                                                    $da = json_decode($nilai->skor);
                                                }
                                                else{
                                                    $da = [0,0];
                                                }
                                                $jml = 0;
                                                @endphp
                @foreach($da as $key => $value)
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Tugas {{ $i }}</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-list-ol"></span></span>
                            <input type="number" name="urutan[]" class="form-control" value="{{ $value }}"/>
                        </div>
                    </div>
                </div>

                @php $i++; $jml += $value;@endphp
                @endforeach
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Jumlah</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-users"></span></span>
                            <input type="text" class="form-control" value="{{ $jml ?? 0 }}" readonly/>
                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Nilai</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-users"></span></span>
                            <input type="text" class="form-control" value="{{ $nilai->nilai ?? 0 }}" readonly/>
                        </div>
                    </div>
                </div>




            </div>
            <div class="panel-footer">
                <a href="{{ route('admin.nilai.show', $ujian->id)}}" class="btn btn-default">Return</a>
                <button type="submit"  class="btn btn-primary pull-right">Submit</button>
            </div>
        </div>

        </form>
    </div>
</div>
<!-- END WIDGETS -->




@endsection

@section('javascript')

@endsection
