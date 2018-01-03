<div class="header navbar navbar-fixed-top mega-menu">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="header-inner">
        <!-- BEGIN LOGO -->
        <a class="navbar-brand" href="/">
            <img src="{{URL::asset('Elegantic/images/ALC.png')}}" class="img-responsive"/>
        </a>
        <!-- END LOGO -->
        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <!-- <img src="assets/img/menu-toggler.png" alt=""/> -->
            <i class="fa fa-bars"></i>
        </a>
        <!-- END HORIZANTAL MENU -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <ul class="nav navbar-nav pull-right" style="cursor: pointer; margin-right:0px !important;">
            <!-- BEGIN USER LOGIN DROPDOWN -->
            @if (Auth::guest())
                <li><a class="btn btn-small btn-sm pull-right bg-secondary" href="{{ route('login') }}" style="padding-top:20px; padding-bottom:20px; background-color:#ccc !important;"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;Login</a></li>
            @else
                <li class="dropdown user">

                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" src="{{ url('assets/img/avatar1_small.jpg') }}"/>
                        <span class="username hidden-1024">{{Auth::user()->get_nama()}}</span>
                        <i class="fa fa-angle-down"></i>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li class="login">
                            @if(Auth::user()->is_admin == 1)
                                <a href="{{ url('/personnel') }}">
                                    Acting As Admin
                                </a>
                            @endif
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                               style="
                                    :hover{
                                        background-color: red;
                                    }"
                            >
                                Logout
                            </a>


                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            @endif
        </ul>
        <!-- END TOP NAVIGATION MENU -->
        <!-- BEGIN HORIZANTAL MENU -->
        <div class="hor-menu hidden-sm hidden-xs navbar-collapse collapse pull-right">
            <ul class="nav navbar-nav" style="margin-right:0px !important;">
                <li class="classic-menu-dropdown {{ Request::is('/') ? 'active' : '' }}">
                    <a href="{{ url('/') }}">
                        Home
                        <span class="{{ Request::is('/') ? 'selected' : '' }}"></span>
                    </a>
                </li>
                <li class="classic-menu-dropdown {{ Request::is('news-board') ? 'active' : '' }}">
                    <a href="{{ url('/news-board') }}">News</a>
                    <span class="{{ Request::is('news-board') ? 'selected' : '' }}"></span>
                </li>
                @if(Auth::user())
                    <li class="classic-menu-dropdown {{ Request::is('forum') ? 'active' : '' }}">
                        <a href="{{url('/forum')}}">Forum</a>
                        <span class="{{ Request::is('forum') ? 'selected' : '' }}"></span>
                    </li>



                    <li class="classic-menu-dropdown {{ Request::is('module/*') ? 'active' : '' }}">
                        <a data-toggle="dropdown"
                           data-hover="dropdown"
                           data-close-others="true"
                           href="#"
                           id="dropdownMenuButton"
                           class="dropdown-toggle"
                        >
                            My Modules <i class="fa fa-angle-down"></i>
                        </a>
                        <span class="{{ Request::is('module/*') ? 'selected' : '' }}"></span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            @foreach ($module as $modul)
                                <li>
                                    {{--<a href="/module/{{$modul->id}}">{{$modul->nama}}</a>--}}
                                    <a href="{{ url('/module/'.$modul->id) }}">{{$modul->nama}}</a>

                                </li>
                            @endforeach
                        </ul>
                    </li>
                    @if(Request::is('raport/*'))
                        <li class="classic-menu-dropdown {{ Request::is('raport/*') ? 'active' : '' }}">

                            <a href="{{ url('/raport/'.Auth::user()->id) }}">My Profile</a>
                            <span class="{{ Request::is('raport/*') ? 'selected' : '' }}"></span>
                            <span class="{{ Request::is('reset-password/*') ? 'selected' : '' }}"></span>
                        </li>
                    @else
                        <li class="classic-menu-dropdown {{ Request::is('reset-password') ? 'active' : '' }}">

                            <a href="{{ url('/raport/'.Auth::user()->id) }}">My Profile</a>

                            <span class="{{ Request::is('reset-password') ? 'selected' : '' }}"></span>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>

<!-- Responsive Toogle -->
<div class="page-sidebar navbar-collapse collapse">

    <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
        <li class="selected">
            <a href="/">
                Home
                {{--<span class="selected"></span>--}}
            </a>
        </li>
        <li class=""><a href="{{ url('news-board') }}">News</a></li>
        @if(Auth::user())
            <li class=""><a href="{{url('/forum')}}">Forum</a></li>
            <li class="classic-menu-dropdown">
                <a>
                    My Modules <i class="arrow fa fa-angle-down"></i>
                </a>
                <ul class="sub-menu">
                    @foreach ($module as $modul)
                        <li>
                            <a href="{{ url('/module/'.$modul->id) }}">{{$modul->nama}}</a>
                        </li>
                    @endforeach
                </ul>

            </li>

            <li class="classic-menu-dropdown"><a href="{{ url('/raport/'.Auth::user()->id) }}">My Profile</a></li>

            <li class="login">
                @if(Auth::user()->is_admin == 1)
                    <a href="/personnel">
                        Acting As Admin
                    </a>
                @endif
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                   style="
                                    :hover{
                                        background-color: red;
                                    }"
                >
                    Logout
                </a>


                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
            </li>
        @endif
    </ul>

</div>