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
            <div class="box-header">
              <h4>View News</h4> <span class="pull-right"><a href="<?php echo e(url('news_edit',$news->id)); ?>"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit_this_news</i></a> <a href="<?php echo e(url('news_remove',$news->id)); ?>"><i style="color:red;" class="fa fa-remove" aria-hidden="true">delete_this_news</i></a></span>
            </div>
            <div class="box-body">
                <!-- CONTENT -->
                <?php if($news->is_publish == 0): ?>
                <div class="col-md-12">
                  <a href="<?php echo e(url('news_publish',$news->id)); ?>" class="btn btn-success" style="width: 100%">publish news</a>
                </div>
                <?php else: ?>
                <div class="col-md-12">
                  <a href="<?php echo e(url('news_unpublish',$news->id)); ?>" class="btn btn-warning" style="width: 100%">unpublish news</a>
                </div>
                <?php endif; ?>
                <div id="news_content">
                  <div class="col-xs-12 col-sm-6 col-md-4">
                    <img src="<?php echo e(URL::asset($news->url_image)); ?>" style="width: 100%; height: 150px;">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-8">
                    <h3><strong><?php echo e($news->title); ?></strong></h3>
                  </div>
                  
                  <p><?php echo html_entity_decode($news->content); ?></p>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                    <?php if(count($news['attachments'])): ?>
                      <?php $__currentLoopData = $news['attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h6 style="text-indent: 20px;">* <a href="<?php echo e(url($attachment->attachment_url)); ?>"><?php echo e($attachment->attachment_name); ?></a></h6>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      no attachment
                    <?php endif; ?>
                  </div>
                </div>
            
          <!-- /.box -->
        </div>
    </div>
    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>