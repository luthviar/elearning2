<?php $__env->startSection('content_training'); ?>

  <?php $__currentLoopData = Session::get('training')['chapter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <?php if($key < $finish_chapter): ?>
<?php if($modal): ?>
<?php echo e('muncul'); ?>

<?php else: ?>
    <?php echo e('gamuncul'); ?>

<?php endif; ?>
          <div style="padding-bottom: 10px;">
              
              <?php if($chapter->category == 0): ?>
                  <a
                    
                     onclick="window.open('<?php echo e(url('/material',$chapter->id)); ?>','_self')"
                     class="btn btn-default" style="width: 100%;text-align: left;">
                      <?php echo e($chapter->chapter_name); ?>

                  </a>
              <?php else: ?>
                  <a
                     
                     
                     onclick="window.open('<?php echo e(url('/test',$chapter->id)); ?>','_self')"
                     class="btn btn-default"
                     style="width: 100%;text-align: left;"><?php echo e($chapter->chapter_name); ?></a>
              <?php endif; ?>
          </div>
      <?php else: ?>
          <div style="padding-bottom: 10px;">
              <a class="btn btn-default" style="width: 100%;text-align: left;" disabled="true"><?php echo e($chapter->chapter_name); ?></a>
          </div>
      <?php endif; ?>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('user.training.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>