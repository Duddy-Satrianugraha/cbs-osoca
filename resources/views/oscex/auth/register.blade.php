@extends('layouts.site')

@section('css')

@endsection

@section('content')


        <div class="login-title" style="color: #450163;"><strong style="color: white;">Pendaftaran</strong> Mahasiswa</div>
        <form action="{{ route('register') }}" class="form-horizontal" method="post">
            @csrf
        <div class="form-group @error('name') has-error @enderror">
            <div class="col-md-12">
                <input type="text" name='name' class="form-control" value="{{ old('name') }}" placeholder="Nama"/>
            </div>
        </div>
        <div class="form-group @error('npm') has-error @enderror">
            <div class="col-md-12">
                <input type="text" name='npm' class="form-control" value="{{ old('npm') }}" placeholder="NPM"/>
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
                <label for="captcha" style="background-color: rgb(202, 111, 0); color: rgb(255, 255, 255); padding: 8px 12px; border-radius: 4px; display: inline-block;">
                    {{ generate_captcha() }}</label>
                <input type="text" name="captcha" class="form-control" placeholder="jawaban captcha, angka saja" required/>
                <input type="hidden" name="code" value="5e25c197ae1f74a267a7737c8d89e6d1"/>
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-6">
                <a href="{{ route('login')}}" class="btn btn-link">Sudah pernah daftar ?</a>
            </div>
            <div class="col-md-6">
                <button class="btn btn-block" style="background-color: #450163; color: white;">Daftar</button>
            </div>
        </div>

        </form>


@endsection

@section('links')
<a href="{{ route('penguji.login')}}">Penguji</a> |
@endsection

@section('javascript')

@endsection

