<div class="header navbar navbar-fixed-top mega-menu" id="p1">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="header-inner">
        <!-- BEGIN LOGO -->
        <a class="navbar-brand" href="<?php echo e(url('/')); ?>">
            <img src="<?php echo e(URL::asset('Elegantic/images/ALC.png')); ?>" class="img-responsive"/>
        </a>
        <!-- END LOGO -->
        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <!-- <img src="assets/img/menu-toggler.png" alt=""/> -->
            <i class="fa fa-bars"></i>
        </a>
        <!-- END HORIZANTAL MENU -->


        <!-- BEGIN TOP NAVIGATION MENU -->
        <ul class="nav navbar-nav pull-right" style="cursor: pointer; margin-right:0px !important;">
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <?php if(Auth::guest()): ?>
                <li><a class="btn btn-small btn-sm pull-right bg-secondary" href="<?php echo e(route('login')); ?>" style="padding-top:20px; padding-bottom:20px; background-color:#ccc !important;"><i class="fa fa-user-circle" aria-hidden="true"></i>&nbsp;Login</a></li>
            <?php else: ?>
                <li class="dropdown user">

                    <a class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <img alt="" src="<?php echo e(url('assets/img/avatar1_small.jpg')); ?>"/>
                        <span class="username hidden-1024"><?php echo e(Auth::user()->name); ?></span>
                        <i class="fa fa-angle-down"></i>
                    </a>

                    <ul class="dropdown-menu" role="menu">
                        <li class="login">
                            <?php if(Auth::user()->role == 1): ?>
                                <a href="<?php echo e(URL::action('UserController@personnel_list')); ?>">
                                    Acting As Admin
                                </a>
                            <?php endif; ?>
                            <a href="<?php echo e(route('logout')); ?>"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();"
                               style="
                                    :hover{
                                        background-color: red;
                                    }"
                            >
                                Logout
                            </a>


                            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                                <?php echo e(csrf_field()); ?>

                            </form>
                        </li>
                    </ul>
                </li>
            <?php endif; ?>
        </ul>
        <!-- END TOP NAVIGATION MENU -->
        <!-- BEGIN HORIZANTAL MENU -->
        <div class="hor-menu hidden-sm hidden-xs navbar-collapse collapse pull-right">
            <ul class="nav navbar-nav" style="margin-right:0px !important;">
                <li class="classic-menu-dropdown <?php echo e(Request::is('/') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/')); ?>">
                        Home
                        <span class="<?php echo e(Request::is('/') ? 'selected' : ''); ?>"></span>
                    </a>
                </li>
                <li
                        class="classic-menu-dropdown <?php echo e(Request::is('news-board') ||
                                    Request::is('news/*')
                                     ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/news-board')); ?>">News</a>
                    <span class="<?php echo e(Request::is('news-board') ||
                                    Request::is('news/*')
                                     ? 'selected' : ''); ?>"></span>
                </li>
                <?php if(Auth::user()): ?>
                    <li class="classic-menu-dropdown <?php echo e(Request::is('forum') || Request::is('forum/*') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/forum')); ?>">Forum</a>
                        <span class="<?php echo e(Request::is('forum') || Request::is('forum/*') ? 'selected' : ''); ?>"></span>
                    </li>



                    <li class="classic-menu-dropdown <?php echo e(Request::is('get_training/*') ||
                        Request::is('material/*') ||
                        Request::is('test/*') ||
                        Request::is('review_test/*')
                         ? 'active' : ''); ?>">
                        <a data-toggle="dropdown"
                           data-hover="dropdown"
                           data-close-others="true"
                           href="#"
                           id="dropdownMenuButton"
                           class="dropdown-toggle"
                        >
                            My Modules <i class="fa fa-angle-down"></i>
                        </a>
                        <span class="<?php echo e(Request::is('get_training/*') ||
                        Request::is('material/*') ||
                        Request::is('test/*') ||
                        Request::is('review_test/*')
                         ? 'selected' : ''); ?>"></span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php $__currentLoopData = Session::get('module'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><a href="<?php echo e(url('/get_training', $modul->id)); ?>"><?php echo e($modul->modul_name); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <?php if(Request::is('profile')): ?>
                        <li class="classic-menu-dropdown <?php echo e(Request::is('profile') ? 'active' : ''); ?>">

                            <a href="<?php echo e(url('profile')); ?>">My Profile</a>
                            <span class="<?php echo e(Request::is('profile') ? 'selected' : ''); ?>"></span>
                            <span class="<?php echo e(Request::is('reset-password/*') ? 'selected' : ''); ?>"></span>
                        </li>
                    <?php else: ?>
                        <li class="classic-menu-dropdown <?php echo e(Request::is('reset-password') ? 'active' : ''); ?>">

                            <a href="<?php echo e(url('profile')); ?>">My Profile</a>

                            <span class="<?php echo e(Request::is('reset-password') ? 'selected' : ''); ?>"></span>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
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
                
            </a>
        </li>
        <li class=""><a href="<?php echo e(url('news-board')); ?>">News</a></li>
        <?php if(Auth::user()): ?>
            <li class=""><a href="<?php echo e(url('/forum')); ?>">Forum</a></li>
            <li class="classic-menu-dropdown">
                <a>
                    My Modules <i class="arrow fa fa-angle-down"></i>
                </a>
                <ul class="sub-menu">
                    <?php $__currentLoopData = Session::get('module'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
									<a href="<?php echo e(url('/get_training', $modul->id)); ?>"><?php echo e($modul->modul_name); ?></a>
								</li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

            </li>

            <?php if(Request::is('profile/*')): ?>
                <li class="classic-menu-dropdown <?php echo e(Request::is('profile/*') ? 'active' : ''); ?>">

                    <a href="<?php echo e(url('profile')); ?>">My Profile</a>
                    <span class="<?php echo e(Request::is('profile/*') ? 'selected' : ''); ?>"></span>
                    <span class="<?php echo e(Request::is('reset-password/*') ? 'selected' : ''); ?>"></span>
                </li>
            <?php else: ?>
                <li class="classic-menu-dropdown <?php echo e(Request::is('reset-password') ? 'active' : ''); ?>">

                    <a href="<?php echo e(url('/raport/'.Auth::user()->id)); ?>">My Profile</a>

                    <span class="<?php echo e(Request::is('reset-password') ? 'selected' : ''); ?>"></span>
                </li>
            <?php endif; ?>

            <li class="login">
                <?php if(Auth::user()->role == 1): ?>
                    <a href="<?php echo e(URL::action('UserController@personnel_list')); ?>">
                        Acting As Admin
                    </a>
                <?php endif; ?>
                <a href="<?php echo e(route('logout')); ?>"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();"
                   style="
                        :hover{
                            background-color: red;
                        }"
                >
                    Logout
                </a>


                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo e(csrf_field()); ?>

                </form>
            </li>
        <?php endif; ?>
    </ul>

</div>