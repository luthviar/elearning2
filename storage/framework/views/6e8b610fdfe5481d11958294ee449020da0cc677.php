<?php $__env->startSection('page-name'); ?>
    <a href="<?php echo e(url()->previous()); ?>">
        <i class="fa fa-arrow-left"></i>
    </a>
    View Forum
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
      

          <div class="box box-primary">
            
            <div class="box-body">
                <!-- CONTENT -->
                
                <div id="news_content">
                  
                  <h3><strong><?php echo e($forum->title); ?></strong></h3>
                  
                  <p><?php echo $forum->content; ?></p>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                    <?php if($forum['attachment'] instanceof Traversable): ?>
                      <?php $__currentLoopData = $forum['attachment']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h6 style="text-indent: 20px;">* <?php echo e($attachment->name); ?></h6>
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

    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>