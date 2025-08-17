@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
    <li ><a href="{{ route('admin.users.index')}}">Admin User</a></li>
        <li class="active">Edit {{ $user->name }}</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> Admin Users</h2>
</div>
@endsection
@section('content')

<!-- START WIDGETS -->
<div class="row">
    <div class="col-md-12">

        <form class="form-horizontal" action="{{ route('admin.users.update', $user->id) }}" method="POST">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><strong>Edit</strong> User</h3>
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
                    <label class="col-md-3 col-xs-12 control-label">Nama</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                            <input type="text" name="name" class="form-control" value="{{ $user->name }}"/>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Email</label>
                    <div class="col-md-6 col-xs-12">
                        <div class="input-group">
                            <span class="input-group-addon"><span class="fa fa-envelope"></span></span>
                            <input type="text" name="email" class="form-control" value="{{ $user->email }}"/>
                        </div>
                    </div>
                </div>


                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Checkbox</label>
                    <div class="col-md-6 col-xs-12">
                        @foreach ($roles as $role)
                        <label class="check"><input type="checkbox" class="icheckbox" name = "roles[]" value="{{ $role->id}}" @if($user->roles->pluck('id')->contains($role->id))  checked="checked" @endif/> {{$role->nama}}</label>
                        @endforeach
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 col-xs-12 control-label">Team (hanya untuk Materi)</label>
                    <div class="col-md-6 col-xs-12">
                        <select name="teams" class="form-control">
                            <option value="">Select Team</option>
                            @foreach ($team as $t)
                            <option value="{{ $t->tu_id}}" @if($user->teams->pluck('tu_id')->contains($t->tu_id))  selected="selected" @endif>{{ $t->name}}</option>
                            @endforeach
                        </select>
                    </div>
                 </div>


            </div>
            <div class="panel-footer">
                <a href="{{ route('admin.users.index')}}" class="btn btn-default">Return</a>
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
