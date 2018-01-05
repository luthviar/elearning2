<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View News
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo e(url('/admin_news')); ?>">News</a></li>
        <li class="active"><?php echo e($news->title); ?></li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
          <div class="box box-primary">
            <div class="box-body">
                <!-- CONTENT -->
                <div id="news_content">
                  <div class="col-xs-12 col-sm-6 col-md-4">
                    <img src="<?php echo e(URL::asset('gambar.png')); ?>" style="width: 100%; height: 150px;">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-8">
                    <h3><strong><?php echo e($news->title); ?></strong></h3>
                  </div>
                  
                  <p><?php echo e($news->content); ?></p>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                    <?php if($news['attachment'] instanceof Traversable): ?>
                      <?php $__currentLoopData = $news['attachment']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h6 style="text-indent: 20px;">* <?php echo e($attachment->attachment_name); ?></h6>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      no attachment
                    <?php endif; ?>
                  </div>
                </div>
            
          <!-- /.box -->
        </div>
    </div>
    <div class="row text-center">
      <button class="btn btn-success">Edit This News</button>
    </div>
    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layout_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>