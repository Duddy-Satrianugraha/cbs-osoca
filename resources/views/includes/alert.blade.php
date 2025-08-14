@if(session('msg'))
@php $satu = session('msg'); $msg= explode("-",$satu);
@endphp
<div class="alert alert-{{ $msg[0] }}" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>

       @switch($msg[0])
           @case('success')
               <strong><span class="fa fa-check-square fa-lg"> {{ $msg[1] }} </span></strong>
               @break
           @case('danger')
               <strong><span class="fa fa-warning fa-lg"> {{ $msg[1] }} </span></strong>
               @break
            @case('warning')
                   <strong> <span class="fa fa-bookmark fa-lg"> {{ $msg[1] }} </span></strong>
                   @break
           @default
           {!!  $msg[1] !!}
       @endswitch
</div>
@endif

@if (count($errors) > 0)

        <div class="alert alert-danger" role="alert">
            <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            @foreach ($errors->all() as $error)
            &#9888; {{ $error }} <br/>
            @endforeach
        </div>

@endif

@if(session('status'))
<div class="alert alert-success" role="alert">
    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
    <strong> &#x0021; {{ session('status') }}</strong>
</div>
@endif
