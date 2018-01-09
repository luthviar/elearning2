<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo e(URL::asset('AdminLTE/dist/img/user2-160x160.jpg')); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo e(Auth::user()->name); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            
            <li class="treeview <?php echo e(Request::is('admin/personnel/*') ||
                     Request::is('admin/personnel')
                     ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>Personnel</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo e(Request::is('admin/personnel')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::action('UserController@personnel_list')); ?>"><i class="fa fa-circle-o"></i>
                            View Personnel</a></li>

                    <li class="<?php echo e(Request::is('admin/personnel/add')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::action('UserController@personnel_add')); ?>"><i class="fa fa-circle-o"></i>
                            Add Personnel</a></li>
                </ul>
            </li>

            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-pencil"></i>
                    <span>Training</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(URL::action('TrainingController@admin_training')); ?>"><i class="fa fa-circle-o"></i>
                            View Training</a></li>
                    <li><a href="<?php echo e(URL::action('TrainingController@add_training')); ?>"><i class="fa fa-circle-o"></i>
                            Add Training</a></li>
                </ul>
            </li>

            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Request Access</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-circle-o"></i> Training Access</a></li>
                    <li><a href="pages/UI/icons.html"><i class="fa fa-circle-o"></i> System Access</a></li>
                </ul>
            </li>

            
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-sliders" aria-hidden="true"></i>
                    <span>Slider</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(URL::action('SliderController@slider_list')); ?>">
                            View Slider
                        </a></li>
                    <li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i>
                            Add Slider
                        </a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    <span> News</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('admin_news')); ?>"><i class="fa fa-circle-o"></i> View News</a></li>
                    <li><a href="<?php echo e(url('news_add')); ?>"><i class="fa fa-circle-o"></i> Add News</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-weixin" aria-hidden="true"></i>
                    <span>Forum</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="<?php echo e(url('admin_forum_public')); ?>"><i class="fa fa-circle-o"></i> Public Forum</a></li>
                    <li><a href="<?php echo e(url('admin_forum_job_family')); ?>"><i class="fa fa-circle-o"></i> Job Family Forum</a></li>
                    <li><a href="<?php echo e(url('admin_forum_department')); ?>"><i class="fa fa-circle-o"></i> Department Forum</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>