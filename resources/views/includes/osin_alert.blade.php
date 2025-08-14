{{-- ALERT SECTION --}}
@if(session('msg'))
@php $satu = session('msg'); $msg = explode("-", $satu); @endphp
<div class="alert alert-{{ $msg[0] }} alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
    @switch($msg[0])
        @case('success')
            <strong><i class="fa fa-check-square"></i> {{ $msg[1] }}</strong>
            @break
        @case('danger')
            <strong><i class="fa fa-warning"></i> {{ $msg[1] }}</strong>
            @break
        @case('warning')
            <strong><i class="fa fa-bookmark"></i> {{ $msg[1] }}</strong>
            @break
        @default
            {!! $msg[1] !!}
    @endswitch
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
    @foreach ($errors->all() as $error)
        <i class="fa fa-warning"></i> {{ $error }} <br/>
    @endforeach
</div>
@endif

@if(session('status'))
<div class="alert alert-success alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert">
        <span aria-hidden="true">&times;</span>
    </button>
    <strong><i class="fa fa-check-circle"></i> {{ session('status') }}</strong>
</div>
@endif
