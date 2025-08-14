@extends('layouts.site')

@section('css')

@endsection

@section('content')


        <div class="login-title" style="color: #015863;"><strong style="color: white;">Pendaftaran</strong> Pasien Standar</div>
        <form action="{{ route('register') }}" class="form-horizontal" method="post">
            @csrf
        <div class="form-group @error('name') has-error @enderror">
            <div class="col-md-12">
                <input type="text" name='name' class="form-control" value="{{ old('name') }}" placeholder="Nama"/>
            </div>
        </div>
        <div class="form-group @error('username') has-error @enderror">
            <div class="col-md-12">
                <input type="text" name='username' class="form-control" value="{{ old('username') }}" placeholder="Username PS"/>
            </div>
        </div>
        <div class="form-group @error('email') has-error @enderror">
            <div class="col-md-12">
                <input type="email" name='email' class="form-control" value="{{ old('email') }}" placeholder="E-mail"/>
            </div>
        </div>

        <div class="form-group @error('password') has-error @enderror">
            <div class="col-md-12">
                <input type="password" name='password' class="form-control"  placeholder="Password"/>
            </div>
        </div>
        <div class="form-group @error('password') has-error @enderror">
            <div class="col-md-12">
                <input type='password' name="password_confirmation" class="form-control" placeholder="Konfirmasi Password"/>
            </div>
        </div>
        <div class="form-group @error('captcha') has-error @enderror">
            <div class="col-md-12">
                <label for="captcha" style="background-color: rgb(68, 0, 255); color: rgb(255, 255, 255); padding: 8px 12px; border-radius: 4px; display: inline-block;">
                    {{ generate_captcha() }}</label>
                <input type="text" name="captcha" class="form-control" placeholder="jawaban captcha, angka saja" autocomplete="off" required/>
                <input type="hidden" name="code" value="2932e5e2847f0af22ef9d54eb6aebda7"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <a href="{{ route('ps.login')}}" class="btn btn-link">Sudah pernah daftar ?</a>
            </div>
            <div class="col-md-6">
                <button class="btn btn-info btn-block">Daftar</button>
            </div>
        </div>

        </form>


@endsection

@section('links')
<a href="{{ route('login')}}">Mahasiswa</a> |
@endsection

@section('javascript')

@endsection

