<ul class="x-navigation x-navigation-horizontal">
    <li class="xn-logo">
        <a href="{{ route('osce.index')}}">{{ config('app.name', 'Arap') }}</a>
        <a href="#" class="x-navigation-control"></a>
    </li>
    @isset(session()->all()['penguji_id'])
    <li class="xn-openable">
        <a href="{{ route('osce.template') }}" target="_blank">
            <span class="fa fa-files-o"></span>
            <span class="xn-text">Template</span>
        </a>
    </li>
@endisset
    <!-- SIGN OUT -->
    <li class="xn-icon-button pull-right">
        <a href="#" class="mb-control" data-box="#mb-signout"><span class="fa fa-sign-out"></span></a>
    </li>
    <!-- END SIGN OUT -->
</ul>
