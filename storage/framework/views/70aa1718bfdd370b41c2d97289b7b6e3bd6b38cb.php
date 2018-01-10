<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo e(url(action('UserController@personnel_list'))); ?>" class="logo">
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
                        <img src="<?php echo e(URL::asset('AdminLTE/dist/img/user2-160x160.jpg')); ?>" class="user-image" alt="User Image">
                        <span class="hidden-xs"><?php echo e(Auth::user()->name); ?></span>
                    </a>

                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="<?php echo e(URL::asset('AdminLTE/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">

                            <p>
                                <?php echo e(Auth::user()->name); ?>

                                <small>Employee since: <?php echo e(Auth::user()->date_join_acs); ?></small>
                            </p>
                        </li>

                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <small>Grade: <br/> <?php echo e(Session::get('profile')['level']->nama_level); ?></small>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <small>Position : <br/> <?php echo e(Auth::user()->position_name); ?></small>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <small>Dept : <br/> <?php echo e(Session::get('profile')['employee_data']['department']->department_name); ?></small>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>

                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="<?php echo e(url(action('HomeController@index'))); ?>" class="btn btn-default btn-flat">Act As User</a>
                            </div>
                            <div class="pull-right">
                                <a href="<?php echo e(route('logout')); ?>"
                                   onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();"

                                   class="btn btn-danger btn-flat">
                                    Logout
                                </a>
                                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                    <?php echo e(csrf_field()); ?>

                                </form>
                            </div>
                        </li>

                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>