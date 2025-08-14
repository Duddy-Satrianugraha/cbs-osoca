@extends('layouts.osce')

@section('css')

@endsection

@section('breadcrumb')
   <!-- START BREADCRUMB -->
   <ul class="breadcrumb push-down-0">
    <li><a href="#">Home</a></li>
    <li><a href="#">Layouts</a></li>
    <li class="active">Frame Right Column</li>
</ul>
<!-- END BREADCRUMB -->
@endsection

@section('page-title')

@endsection

@section('content')

<!-- START CONTENT FRAME -->
<div class="content-frame">

    <!-- START CONTENT FRAME TOP -->
    <div class="content-frame-top">
        <div class="page-title">
            <h2><span class="fa fa-arrow-circle-o-left"></span> Frame Title</h2>
        </div>
        <div class="pull-right">
            <button class="btn btn-default content-frame-right-toggle"><span class="fa fa-bars"></span></button>
        </div>
    </div>
    <!-- END CONTENT FRAME TOP -->

    <!-- START CONTENT FRAME LEFT -->
    <div class="content-frame-right">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3 class="push-up-0">Right Column</h3>
                Right side disappear on mobile devices, and can be shown by pressing toggle button.
            </div>
        </div>
    </div>
    <!-- END CONTENT FRAME LEFT -->

    <!-- START CONTENT FRAME BODY -->
    <div class="content-frame-body content-frame-body-left">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Responsive Body</h3>
                This is responsive frame body. Can be used for all ediatas
            </div>
        </div>
    </div>
    <!-- END CONTENT FRAME BODY -->

</div>
<!-- END CONTENT FRAME -->


@endsection

@section('javascript')

@endsection
