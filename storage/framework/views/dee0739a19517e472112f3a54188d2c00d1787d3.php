<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View News
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo e(url('/admin_slider')); ?>">Slider</a></li>
        <li class="active"><?php echo e($slider->title); ?></li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
          <div class="box box-primary">
            <div class="box-header">
              <h4>View Slider</h4>  <span class="pull-right"><a href="<?php echo e(url('slider_edit',$slider->id)); ?>"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit_this_slider</i></a> <a href="<?php echo e(url('slider_remove',$slider->id)); ?>"><i style="color:red;" class="fa fa-remove" aria-hidden="true">delete_this_slider</i></a></span>
            </div>
            <div class="box-body">
                <!-- CONTENT -->
                <div class="col-md-12" style="padding-bottom: 20px;">
                  <?php if($count < 5): ?>
                    <?php if($slider['flag_active'] == 0): ?>
                    <a href="<?php echo e(url('slider_activate', $slider->id)); ?>" class="btn btn-success" style="width: 100%">Activate</a>
                    <?php else: ?>
                    <a href="<?php echo e(url('slider_nonactivate', $slider->id)); ?>" class="btn btn-warning" style="width: 100%">Non-Activate</a>
                    <?php endif; ?>
                  <?php else: ?>
                    <?php if($slider['flag_active'] == 0): ?>
                    <a disabled="true" class="btn btn-success" style="width: 100%">Activate</a>
                    <?php else: ?>
                    <a href="<?php echo e(url('slider_nonactivate', $slider->id)); ?>" class="btn btn-warning" style="width: 100%">Non-Activate</a>
                    <?php endif; ?>
                  <?php endif; ?>
                </div>
                <div id="news_content">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <img src="<?php echo e(URL::asset($slider->url_image)); ?>" style="width: 100%; height: 250px;border: 1px solid green;">
                    <h3><strong><?php echo e($slider->title); ?></strong></h3>
                    <p><?php echo e($slider->second_title); ?></p>
                  </div>
                  
                </div>
            
          <!-- /.box -->
        </div>
    </div>
    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>