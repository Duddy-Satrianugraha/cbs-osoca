@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li class="active">Profile</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> User Profile</h2>
</div>
@endsection
@section('content')

<!-- START WIDGETS -->
<div class="row">


        <div class="col-md-8">

            <form class="form-horizontal" action="{{ route('user-profile-information.update', Auth::user()->id) }}" method="POST">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Edit</strong> Profile</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    @can('mhs')
                    <p>Pastikan Foto anda Formal dengan background <code>warna merah</code>, ukuran file maksimal 1 MB dan proporsi 4 x 6</p>
                    @endcan
                </div>
                <div class="panel-body form-group-separated">

                        @csrf
                        @method('PUT')
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nama</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}"/>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Email</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                                <input type="text" name="email" class="form-control" value="{{ Auth::user()->email }}"/>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="panel-footer">

                    <button type="submit"  class="btn btn-primary pull-right">Submit</button>
                </div>
            </div>

            </form>
        </div>
        <div class="col-md-3">

            <div class="panel panel-default">
                <div class="panel-body profile" style="background:#3bc4b7f7; " >
                    <div class="profile-image">
                        <label for="profile_photo_input" style="cursor: pointer;">


                        @if(is_null(Auth::user()->avatar))
                            <img   id="profile_photo_preview" src="{{ asset('img/user.jpg') }}" alt="{{ Auth::user()->name }}"/>
                        @else
                            <img id="profile_photo_preview" src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"/>
                        @endif
                        </label>
                         <!-- Input File (Tersembunyi) -->
            <form id="profile_photo_form" action="{{ route('profile.photo.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" id="profile_photo_input" name="avatar" class="d-none" accept="image/*" style="display: none;">
            </form>

                    </div>
                    <div class="profile-data">
                        <div class="profile-data-name">{{ Auth::user()->name }}</div>
                        <div class="profile-data-title" style="color: #FFF;">{{  Auth::user()->roles->first()->nama }}</div>
                    </div>
                    <div class="profile-controls">

                    </div>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            Klik avatar untuk mengganti foto profil
                        </div>

                    </div>
                </div>


            </div>

        </div>
        <div class="col-md-8">

            <form class="form-horizontal" action="{{ route('profile.store') }}" method="POST">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Edit</strong> Data Diri </h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    @php $diri = Auth::user()->dataDiris ?? null; @endphp
                </div>
                <div class="panel-body form-group-separated">
                    @csrf
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Jenis Kelamin</label>
                        <div class="col-md-6 col-xs-12">
                            @php
                                $diri = Auth::user()->dataDiris ?? null;
                                $selectedSex = old('sex_id', $diri->sex ?? '');

                            @endphp
                            <select class="form-control select" name="sex_id">
                                @foreach ($sex as $data)
                                    <option value="{{ $data->value }}" @if($selectedSex == $data->value) selected @endif >
                                        {{ $data->value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Nomor Telepon / Handphone</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa  fa-mobile-phone"></span></span>
                                <input type="number" name="phone" class="form-control" value="{{ old('phone', $diri->phone ?? '') }}"/>
                            </div>

                        </div>
                    </div>

                </div>
                <div class="panel-footer">
                    <button class="btn btn-default">Clear Form</button>
                    <button type="submit"  class="btn btn-primary pull-right">Submit</button>
                </div>
            </div>
            </form>

        </div>
        <div class="col-md-8">

            <form class="form-horizontal" action="{{ route('user-password.update', Auth::user()->id) }}" method="POST">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Edit</strong> Password</h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">

                </div>
                <div class="panel-body form-group-separated">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Password Lama anda</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-unlock"></span></span>
                                <input type="password" name='current_password' class="form-control"/>
                            </div>

                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Password Baru</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-unlock-alt"></span></span>
                                <input type="password" name="password" class="form-control"/>
                            </div>

                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Konfirmasi Password Baru</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                <input type="password" name="password_confirmation" class="form-control"/>
                            </div>

                        </div>
                    </div>


                </div>
                <div class="panel-footer">
                    <button class="btn btn-default">Clear Form</button>
                    <button type="submit"  class="btn btn-primary pull-right">Submit</button>
                </div>
            </div>
            </form>

        </div>




</div>
<!-- END WIDGETS -->




@endsection

@section('javascript')
<script type="text/javascript" src="{{ asset('js/plugins/bootstrap/bootstrap-select.js') }}"></script>
<script>
    document.getElementById('profile_photo_input').addEventListener('change', function() {
        if (this.files && this.files[0]) {
            let reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile_photo_preview').src = e.target.result;
            };
            reader.readAsDataURL(this.files[0]);

            // Submit form otomatis setelah memilih file
            document.getElementById('profile_photo_form').submit();
        }
    });
    </script>
@endsection
