<div id="loadingz" style="display: none; background-color: black;">
    <div id="loading-container" class="fullwidth" style="background-color: black;">
        <div class="spinner">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
        <p id='loading-text'>Loading...</p>
    </div>
</div>
<header class="main-header">
    <!-- Logo -->
    <a href="{{ url(action('UserController@personnel_list')) }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>A</b>LC</span>
        <!-- logo for regular state and mobile devices -->

        <span class="logo-lg"><b>ELearning</b> Admin</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        @if(Auth::user()->photo == null)
                        <img src="{{URL::asset('photo/user-default.png')}}" class="user-image" alt="User Image">
                        @else
                        <img src="{{URL::asset(Auth::user()->photo)}}" class="user-image" alt="User Image">
                        @endif
                        <span class="hidden-xs">{{Auth::user()->name}}</span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            @if(Auth::user()->photo == null)
                            <img src="{{URL::asset('photo/user-default.png')}}" class="img-circle" alt="User Image">
                            @else
                            <img src="{{URL::asset(Auth::user()->photo)}}" class="img-circle" alt="User Image">
                            @endif
                            <p>
                                {{Auth::user()->name}}
                                <small>Employee since: {{Auth::user()->date_join_acs}}</small>
                            </p>
                        </li>

                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <small>Grade: <br/> {{Session::get('profile')['level']->nama_level}}</small>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <small>Position : <br/> {{Auth::user()->position_name}}</small>
                                </div>
                                <div class="col-xs-4 text-center">
                                    @if(Session::get('profile')['employee_data']['department'] != null)
                                    <small>Dept : <br/> {{Session::get('profile')['employee_data']['department']->department_name}}</small>
                                    @else
                                    <small>Dept : <br/> --</small>
                                    @endif
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{ url(action('HomeController@index')) }}" class="btn btn-default btn-flat">Act As User</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"

                                   class="btn btn-danger btn-flat">
                                    Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>