<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <?php if(Auth::user()->photo == null): ?>
                <img src="<?php echo e(URL::asset('photo/user-default.png')); ?>" class="img-circle" alt="User Image">
                <?php else: ?>
                <img src="<?php echo e(URL::asset(Auth::user()->photo)); ?>" class="img-circle" alt="User Image">
                <?php endif; ?>
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
                    <li class="<?php echo e(Request::is('admin/personnel/all') ||
                     Request::is('admin/personnel/view*')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::action('UserController@personnel_list')); ?>"><i class="fa fa-circle-o"></i>
                            View Personnel</a></li>

                    <li class="<?php echo e(Request::is('admin/personnel/add')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::action('UserController@user_add')); ?>"><i class="fa fa-circle-o"></i>
                            Add Personnel</a></li>
                </ul>
            </li>

            
            <li class="treeview <?php echo e(Request::is('admin/training/*') ||
                     Request::is('admin/training')
                     ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-pencil"></i>
                    <span>Training</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo e(Request::is('admin/training/all') ||
                     Request::is('admin/training/manage*')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::action('TrainingController@admin_training')); ?>"><i class="fa fa-circle-o"></i>
                            View Training</a></li>
                    <li class="<?php echo e(Request::is('admin/training/add')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::action('TrainingController@add_training')); ?>"><i class="fa fa-circle-o"></i>
                            Add Training
                        </a>
                    </li>
                    <li><a href="<?php echo e(url('admin/training/schedule')); ?>"><i class="fa fa-circle-o"></i>
                            Schedule</a></li>
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
                    <li><a href="<?php echo e(url('admin/training/admin_access_training')); ?>"><i class="fa fa-circle-o"></i> Training Access</a></li>
                    <li><a href="<?php echo e(url('admin/system/access')); ?>"><i class="fa fa-circle-o"></i> System Access</a></li>
                </ul>
            </li>

            
            <li class="treeview <?php echo e(Request::is('admin/slider/*') ||
                     Request::is('admin/slider')
                     ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-sliders" aria-hidden="true"></i>
                    <span>Slider</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class=" <?php echo e(Request::is('admin/slider/all') ||
                     Request::is('admin/slider/view*') ||
                     Request::is('admin/slider/edit*')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::action('SliderController@slider_list')); ?>"><i class="fa fa-circle-o"></i>
                            View Slider
                        </a></li>
                    <li class=" <?php echo e(Request::is('admin/slider/add')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(url(action('SliderController@add_slider'))); ?>"><i class="fa fa-circle-o"></i>
                            Add Slider
                        </a></li>
                </ul>
            </li>

            
            <li class="treeview <?php echo e(Request::is('admin/news/*') ||
                     Request::is('admin/news')
                     ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    <span> News</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="<?php echo e(Request::is('admin/news/all') ||
                     Request::is('admin/news/view*') ||
                     Request::is('admin/news/edit*')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::action('NewsController@news_list')); ?>"><i class="fa fa-circle-o"></i> View News</a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/news/add')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(URL::action('NewsController@news_add')); ?>"><i class="fa fa-circle-o"></i> Add News</a>
                    </li>
                </ul>
            </li>

            
            <li class="treeview <?php echo e(Request::is('admin/forum/*')
                     ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-weixin" aria-hidden="true"></i>
                    <span>Forum</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="<?php echo e(Request::is('admin/forum/umum*')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(url(action('ForumController@forum_public_list'))); ?>">
                            <i class="fa fa-circle-o"></i>
                            Public Forum
                        </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/forum/job-family*')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(url(action('ForumController@forum_job_family_list'))); ?>">
                            <i class="fa fa-circle-o"></i>
                            Job Family Forum
                        </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/forum/department*')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(url(action('ForumController@forum_department_list'))); ?>">
                            <i class="fa fa-circle-o"></i>
                            Department Forum
                        </a>
                    </li>
                </ul>
            </li>

            
            <li class="treeview <?php echo e(Request::is('admin/links/*')
                     ? 'active' : ''); ?>">
                <a href="#">
                    <i class="fa fa-link" aria-hidden="true"></i>
                    <span>Aerofood Links</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                <ul class="treeview-menu">
                    <li class="<?php echo e(Request::is('admin/links/all') ||
                     Request::is('admin/links/view*') ||
                     Request::is('admin/links/edit*')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(url(action('AerofoodLinksController@index'))); ?>">
                            <i class="fa fa-circle-o"></i>
                            View All
                        </a>
                    </li>
                    <li class="<?php echo e(Request::is('admin/links/add')
                     ? 'active' : ''); ?>">
                        <a href="<?php echo e(url(action('AerofoodLinksController@add'))); ?>">
                            <i class="fa fa-circle-o"></i>
                            Add Link
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>