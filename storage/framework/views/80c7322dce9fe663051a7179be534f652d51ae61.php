<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Forum
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo e(url('/personnel')); ?>">Forum</a></li>
        <?php if($forum->category == 0): ?>
        <li><a href="<?php echo e(url('/admin_forum_public')); ?>">Forum Public</a></li>
        <?php elseif($forum->category == 1): ?>
        <li><a href="<?php echo e(url('/admin_forum_job_family')); ?>">Forum Job Family</a></li>
        <?php else: ?>
        <li><a href="<?php echo e(url('/admin_forum_department')); ?>">Forum Department</a></li>
        <?php endif; ?>
        <li class="active"><?php echo e($forum->title); ?></li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
      

          <div class="box box-primary">
            
            <div class="box-body">
                <!-- CONTENT -->
                
                <div id="news_content">
                  
                  <h3><strong><?php echo e($forum->title); ?></strong></h3>
                  
                  <p><?php echo e($forum->content); ?></p>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                    <?php if($forum['attachment'] instanceof Traversable): ?>
                      <?php $__currentLoopData = $forum['attachment']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attchment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h6 style="text-indent: 20px;">* <?php echo e($attachment->attachment->name); ?></h6>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      no attachment
                    <?php endif; ?>
                  </div>
                
                </div>
              
            </div>
          </div>
          <!-- /.box -->

        </div>
    </div>
    <div class="row text-center">
      <button class="btn btn-success">submit</button>
    </div>


    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>