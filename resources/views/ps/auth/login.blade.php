@extends('layouts.site')

@section('css')

@endsection

@section('content')

        <div class="login-title" style="color: #015863;"><strong style="color: white;">Log In</strong> Pasien Standar</div>
        <form action="{{ route('login') }}" class="form-horizontal" method="post">
            @csrf
        <div class="form-group @error('username') has-error @enderror">
            <div class="col-md-12">
                <input type="text" class="form-control" name='username' placeholder="Username PS" autocomplete="off"/>
            </div>
        </div>
        <div class="form-group @error('password') has-error @enderror">
            <div class="col-md-12">
                <input type="password" name='password' class="form-control" placeholder="Password"/>
            </div>
        </div>
        <div class="form-group @error('captcha') has-error @enderror">
            <div class="col-md-12">
                <label for="captcha" style="background-color: rgb(68, 0, 255); color: rgb(255, 255, 255); padding: 8px 12px; border-radius: 4px; display: inline-block;">
                    {{ generate_captcha() }}</label>
                <input type="text" name="captcha" class="form-control" placeholder="jawaban captcha, angka saja" autocomplete="off" required/>
                <input type="hidden" name="code" value="2930e5e2847f0af22ef9d54eb6aebda7"/>
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-6">
                <a href="{{ route('ps.register') }}" class="btn btn-link ">Belum daftar?</a>
            </div>
            <div class="col-md-6">
                <button class="btn btn-info btn-block">Log In</button>
            </div>
        </div>

        </form>


@endsection

@section('links')
<a href="{{ route('login')}}">Mahasiswa</a> |
<a href="{{ route('osce.login')}}">Osce</a> |
@endsection

@section('javascript')

@endsection

