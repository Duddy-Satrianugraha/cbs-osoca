@extends('layouts.app')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb">
    <li ><a href="{{ route('dashbord')}}">Dashboard</a></li>
        <li class="active">Ability</li>
</ul>
<!-- END BREADCRUMB -->
@endsection
@section('page-title')
<div class="page-title">
    <h2><span class="fa fa-arrow-circle-o-left"></span> list achivement Ability</h2>
</div>
@endsection
@section('content')

<!-- START WIDGETS -->
<div class="row">
                    <!-- START RESPONSIVE TABLES -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">

                                <div class="panel-heading">
                                    <h3 class="panel-title">Ability PS</h3>
                                    <ul class="panel-controls">
                                        <li><a href="{{ route('admin.options.create')}}" class="panel-add"><span class="fa fa-plus"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-12">

                                        <!-- START ACCORDION -->
                                        <div class="panel-group accordion accordion-dc">
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h4 class="panel-title">
                                                        <a href="#accTwoColOne">
                                                           buat baru
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div class="panel-body " id="accTwoColOne">
                                                    <form action="{{ route('admin.options.store') }}" method="POST">
                                                        @csrf
                                                        <div class="form-group">
                                                            <label class="col-md-2 col-xs-12 control-label">Opsi</label>
                                                            
                                                            <div class="col-md-3">
                                                                <input type="text" name='value' class="form-control" placeholder="Nilai"/>
                                                            </div>
                                                        </div>
                                                        <button class="btn btn-primary pull-right">Simpan</button>
                                                    </form>
                                                </div>
                                            </div>

                                        </div>
                                        <!-- END ACCORDION -->

                                    </div>
                                    <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-actions">
                                            <thead>
                                                <tr>
                                                    <th width="50">Nomor</th>
                                                    <th>type </th>
                                                    <th>name</th>
                                                    <th>value</th>
                                                    <th width="100">actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $i =  1;@endphp
                                                @foreach ($option as $data)
                                                <tr id="trow_{{$i}}">
                                                    <td class="text-center">{{$i}}</td>
                                                    <td><strong>{{$data->type}}</strong></td>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->value}}</td>
                                                    <td>

                                                        <form id="del-opt-{{$data->id}}" action="{{ route('admin.options.destroy', $data->id)}}" method="POST" style="display: inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-rounded btn-sm" type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus opsi ini?');"><span class="fa fa-times"></span></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                                @php $i++;@endphp
                                                @endforeach

                                            </tbody>
                                        </table>
                                        {{ $option->links() }}
                                    </div>
                                    </div>
                                </div>



                            </div>

                        </div>
                    </div>
                    <!-- END RESPONSIVE TABLES -->

</div>
<!-- END WIDGETS -->




@endsection

@section('javascript')

@endsection
