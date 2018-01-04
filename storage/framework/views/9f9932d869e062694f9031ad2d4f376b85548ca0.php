<div class="header navbar navbar-fixed-top mega-menu">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="header-inner">
        <!-- BEGIN LOGO -->
        <a class="navbar-brand" href="/">
            <img src="<?php echo e(URL::asset('Elegantic/images/ALC.png')); ?>" class="img-responsive"/>
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
                            <?php if(Auth::user()->is_admin == 1): ?>
                                <a href="<?php echo e(url('/personnel')); ?>">
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
                <li class="classic-menu-dropdown <?php echo e(Request::is('/home2' or '/') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/')); ?>">
                        Home
                        <span class="<?php echo e(Request::is('/' or 'home2') ? 'selected' : ''); ?>"></span>
                    </a>
                </li>
                <li class="classic-menu-dropdown <?php echo e(Request::is('news-board') ? 'active' : ''); ?>">
                    <a href="<?php echo e(url('/news-board')); ?>">News</a>
                    <span class="<?php echo e(Request::is('news-board') ? 'selected' : ''); ?>"></span>
                </li>
                <?php if(Auth::user()): ?>
                    <li class="classic-menu-dropdown <?php echo e(Request::is('forum') ? 'active' : ''); ?>">
                        <a href="<?php echo e(url('/forum')); ?>">Forum</a>
                        <span class="<?php echo e(Request::is('forum') ? 'selected' : ''); ?>"></span>
                    </li>



                    <li class="classic-menu-dropdown <?php echo e(Request::is('module/*') ? 'active' : ''); ?>">
                        <a data-toggle="dropdown"
                           data-hover="dropdown"
                           data-close-others="true"
                           href="#"
                           id="dropdownMenuButton"
                           class="dropdown-toggle"
                        >
                            My Modules <i class="fa fa-angle-down"></i>
                        </a>
                        <span class="<?php echo e(Request::is('module/*') ? 'selected' : ''); ?>"></span>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php $__currentLoopData = $module; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li>
                                    
                                    <a href="<?php echo e(url('/module/'.$modul->id)); ?>"><?php echo e($modul->nama); ?></a>

                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </li>
                    <?php if(Request::is('raport/*')): ?>
                        <li class="classic-menu-dropdown <?php echo e(Request::is('raport/*') ? 'active' : ''); ?>">

                            <a href="<?php echo e(url('/raport/'.Auth::user()->id)); ?>">My Profile</a>
                            <span class="<?php echo e(Request::is('raport/*') ? 'selected' : ''); ?>"></span>
                            <span class="<?php echo e(Request::is('reset-password/*') ? 'selected' : ''); ?>"></span>
                        </li>
                    <?php else: ?>
                        <li class="classic-menu-dropdown <?php echo e(Request::is('reset-password') ? 'active' : ''); ?>">

                            <a href="<?php echo e(url('/raport/'.Auth::user()->id)); ?>">My Profile</a>

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
                    <?php $__currentLoopData = $module; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $modul): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li>
                            <a href="<?php echo e(url('/module/'.$modul->id)); ?>"><?php echo e($modul->nama); ?></a>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>

            </li>

            <li class="classic-menu-dropdown"><a href="<?php echo e(url('/raport/'.Auth::user()->id)); ?>">My Profile</a></li>

            <li class="login">
                <?php if(Auth::user()->is_admin == 1): ?>
                    <a href="/personnel">
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