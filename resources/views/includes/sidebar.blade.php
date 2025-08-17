<div class="page-sidebar">
    <!-- START X-NAVIGATION -->
    <ul class="x-navigation">
        <li class="xn-logo">
            <a href="{{ route('dashbord')}}">{{ config('app.name', 'Arap') }}</a>
            <a href="#" class="x-navigation-control"></a>
        </li>
        <li class="xn-profile">
            <a href="#" class="profile-mini">
                @if(is_null(Auth::user()->avatar))
                            <img src="{{ asset('img/user.jpg') }}" alt="{{ Auth::user()->name }}"/>
                        @else
                            <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"/>
                        @endif
            </a>
            <div class="profile">
                <div class="profile-image">
                    @if(is_null(Auth::user()->avatar))
                        <img src="{{ asset('img/user.jpg') }}" alt="{{ Auth::user()->name }}"/>
                    @else
                        <img src="{{ Auth::user()->avatar }}" alt="{{ Auth::user()->name }}"/>
                    @endif
                </div>
                <div class="profile-data">
                    <div class="profile-data-name">{{ Auth::user()->name }}</div>
                    <div class="profile-data-title">{{ Auth::user()->roles()->first()->nama }}</div>
                </div>
                <div class="profile-controls">

                </div>
            </div>
        </li>
        <li class="xn-title">Navigation</li>
        <li class="{{ \Request::is('dashbord/*') || \Request::is('dashbord') ? 'active' : ''  }}">
            <a href="{{ route('dashbord')}}"><span class="fa fa-desktop"></span> <span class="xn-text"> Dashboard</span></a>
        </li>
        <li class="{{ \Request::is('profile/*') || \Request::is('profile') ? 'active' : ''  }}"
        ><a href="{{ route('profile.index')}}"><span class="fa fa-user"></span><span class="xn-text"> Profile</span> </a></li>
        @can('it')
        <li class="xn-title">IT Administrator</li>
        <li class="{{ \Request::is('admin/users/*') || \Request::is('admin/users') ? 'active' : ''  }}"><a href="{{ route('admin.users.index')}}"><span class="fa fa-users"></span><span class="xn-text"> Users</span> </a></li>
        @endcan
        @can('materi')
        <li class="xn-title">Tim Materi</li>
        <li class="{{ \Request::is('admin/templates/*') || \Request::is('admin/templates') ? 'active' : ''  }}"><a href="{{ route('admin.templates.index')}}"><span class="fa fa-folder"></span><span class="xn-text"> Template ujian</span></a></li>
        <li class="{{ \Request::is('admin/ujian/*') || \Request::is('admin/ujian') ? 'active' : ''  }}"><a href="{{ route('admin.ujian.index')}}"><span class="fa fa-folder"></span><span class="xn-text"> Ujian OSOCA</span></a></li>
         
        @endcan
        @can('admin')
        
        <li class="xn-title">Administrator</li>
        <li class="{{ \Request::is('admin/peserta/*') || \Request::is('admin/peserta') ? 'active' : ''  }}"><a href="{{ route('admin.peserta.index')}}"><span class="fa fa-users"></span><span class="xn-text"> Peserta</span> </a></li>
        <li class="{{ \Request::is('admin/lokasi/*') || \Request::is('admin/lokasi') ? 'active' : ''  }}"><a href="{{ route('admin.lokasi.index')}}"><span class="fa fa-globe"></span><span class="xn-text"> Kartu Station</span> </a></li>
        @endcan
        @can('mhs')
        <li class="xn-title">Mahasiswa</li>
        <li class="{{ \Request::is('mahasiswa/pendaftaran/*') || \Request::is('mahasiswa/pendaftaran') ? 'active' : ''  }}"><a href="{{ Route('mahasiswa.pendaftaran.index')}}"><span class="fa fa-check-square-o"></span><span class="xn-text">Daftar OSCE</span> </a></li>
        @endcan
        @can('pps')
        <li class="xn-title">Pelatih Pasien Standar</li>
        <li class="{{ \Request::is('admin/pasien/*') || \Request::is('admin/pasien') ? 'active' : ''  }}"><a href="{{ Route('admin.pasien.index')}}"><span class="fa fa-users"></span><span class="xn-text">Pasien Standar</span> </a></li>
        <li class="{{ \Request::is('admin/options/*') || \Request::is('admin/options') ? 'active' : ''  }}"><a href="{{ Route('admin.options.create')}}"><span class="fa fa-users"></span><span class="xn-text">PS Ability</span> </a></li>
        @endcan
        @can('ultraman')
        <li class="xn-title">Nav Level</li>
        <li class="xn-openable ">
            <a href="#"><span class="fa fa-files-o"></span> <span class="xn-text">Setting</span></a>
            <ul>
                <li class=""><a href="{{ route('admin.users.index')}}"><span class="fa fa-image"></span> Users</a></li>
                <li><a href="pages-profile.html"><span class="fa fa-user"></span> Profile</a></li>
                <li><a href="pages-address-book.html"><span class="fa fa-users"></span> Address Book</a></li>
                <li class="xn-openable">
                    <a href="#"><span class="fa fa-clock-o"></span> Timeline</a>
                    <ul>
                        <li><a href="pages-timeline.html"><span class="fa fa-align-center"></span> Default</a></li>
                        <li><a href="pages-timeline-simple.html"><span class="fa fa-align-justify"></span> Full Width</a></li>
                    </ul>
                </li>

            </ul>
        </li>
        <li class="xn-openable">
            <a href="#"><span class="fa fa-sitemap"></span> <span class="xn-text">Navigation Levels</span></a>
            <ul>
                <li class="xn-openable">
                    <a href="#">Second Level</a>
                    <ul>
                        <li class="xn-openable">
                            <a href="#">Third Level</a>
                            <ul>
                                <li class="xn-openable">
                                    <a href="#">Fourth Level</a>
                                    <ul>
                                        <li><a href="#">Fifth Level</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>@endcan

    </ul>
    <!-- END X-NAVIGATION -->
</div>
