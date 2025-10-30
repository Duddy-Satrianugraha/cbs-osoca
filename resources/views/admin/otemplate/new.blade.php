@extends('layouts.app')

@section('css')
<style>
    .is-invalid { border-color:#dc3545; }
    .invalid-feedback { color:#dc3545; display:block; }
</style>
@endsection

@section('breadcrumb')
<ul class="breadcrumb">
    <li><a href="{{ route('dashbord') }}">Dashboard</a></li>
    <li><a href="{{ route('admin.templates.index') }}">Daftar Template</a></li>
    <li class="active">Template Baru</li>
</ul>
@endsection

@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Template OSOCA Baru</h2>
</div>
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <form class="form-horizontal" action="{{ route('admin.templates.store') }}" method="POST">
            @csrf
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Template</strong> Soal</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>

                <div class="panel-body">
                    @php($flash = session('msg'))
                    @if($flash)
                        @php($parts = explode('-', $flash, 2))
                        @php($type  = $parts[0] ?? 'info')
                        @php($text  = $parts[1] ?? $flash)
                        <div class="alert alert-{{ $type === 'success' ? 'success' : ($type === 'danger' ? 'danger' : 'info') }}">{{ $text }}</div>
                    @endif
                </div>

                <div class="panel-body form-group-separated">
                    {{-- Nama Template --}}
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nama Template</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text"
                                   class="form-control @error('nama_template') is-invalid @enderror"
                                   name="nama_template"
                                   value="{{ old('nama_template') }}">
                            <small class="text-muted">Label internal, tidak tampil di penguji.</small>
                            @error('nama_template')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Nomor Kasus --}}
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Nomor Kasus</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text"
                                   class="form-control @error('nomor_soal') is-invalid @enderror"
                                   name="nomor_soal"
                                   value="{{ old('nomor_soal') }}">
                            @error('nomor_soal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Judul Kasus --}}
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Judul Kasus</label>
                        <div class="col-md-8 col-xs-12">
                            <input type="text"
                                   class="form-control @error('judul_soal') is-invalid @enderror"
                                   name="judul_soal"
                                   value="{{ old('judul_soal') }}">
                            @error('judul_soal')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    {{-- Rubrik Dinamis --}}
                    <div class="form-group">
                        <label class="col-md-2 col-xs-12 control-label">Rubrik Penilaian</label>
                        <div class="col-md-8 col-xs-12">
                            @error('rubrik')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <div class="table-responsive">
                                <table class="table table-bordered" id="rubrik-table">
                                    <thead>
                                        <tr>
                                            <th style="width:60px;">No</th>
                                            <th>Nama Rubrik</th>
                                            <th style="width:80px;">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php($oldRubrik = old('rubrik', [['name' => '']]))
                                        @foreach($oldRubrik as $idx => $item)
                                            <tr>
                                                <td class="urut text-center">{{ $loop->iteration }}</td>
                                                <td>
                                                    <input type="text"
                                                           name="rubrik[{{ $idx }}][name]"
                                                           class="form-control @error('rubrik.'.$idx.'.name') is-invalid @enderror"
                                                           value="{{ old('rubrik.'.$idx.'.name', $item['name'] ?? '') }}"
                                                           placeholder="Contoh: Penjelasan pathogenesis dan manifestasi klinis">
                                                    @error('rubrik.'.$idx.'.name')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-sm btn-danger remove-row" type="button">&times;</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <button type="button" id="add-row" class="btn btn-sm btn-primary">+ Tambah Rubrik</button>
                            <small class="text-muted">Minimal 1 rubrik. Klik × untuk hapus baris.</small>
                        </div>
                    </div>
                </div>

                <div class="panel-footer">
                    <a class="btn btn-default" href="{{ route('admin.templates.index') }}">Kembali</a>
                    <button class="btn btn-primary" type="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>

<template id="row-template">
    <tr>
        <td class="urut text-center"></td>
        <td>
            <input type="text" name="__NAME__" class="form-control" placeholder="Tulis nama rubrik">
        </td>
        <td class="text-center">
            <button type="button" class="btn btn-sm btn-danger remove-row">&times;</button>
        </td>
    </tr>
</template>
@endsection

@section('javascript')
<script>
(function(){
    var table = document.getElementById('rubrik-table');
    var tbody = table.querySelector('tbody');
    var addBtn = document.getElementById('add-row');
    var tpl = document.getElementById('row-template');

    function renumber() {
        var rows = tbody.querySelectorAll('tr');
        rows.forEach(function(tr, i){
            var no = tr.querySelector('.urut');
            if (no) no.textContent = (i+1).toString();
            var input = tr.querySelector('input[type="text"]');
            if (input) input.name = 'rubrik[' + i + '][name]';
        });
    }

    addBtn.addEventListener('click', function(){
        var clone = document.importNode(tpl.content, true);
        clone.querySelector('input').name = 'rubrik[' + tbody.children.length + '][name]';
        tbody.appendChild(clone);
        renumber();
    });

    table.addEventListener('click', function(e){
        if (!e.target.classList.contains('remove-row')) return;
        var tr = e.target.closest('tr');
        if (tbody.children.length <= 1) {
            var input = tr.querySelector('input[type="text"]');
            if (input) input.value = '';
            return;
        }
        tr.remove();
        renumber();
    });

    document.addEventListener('DOMContentLoaded', renumber);
})();
</script>
@endsection
