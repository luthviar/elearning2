<?php $__env->startSection('content'); ?>

<div class="row" style="padding-top: 20px;">
  <div class="container">
    <div class="text-center">
      <h4><strong><?php echo e($training->modul_name); ?></strong></h4>
      <h5>Contain <?php echo e(count($training['chapter'])); ?> chapter . 1271 user finish this course</h5>
      <p><?php echo e($training['description']); ?></p>
    </div>
    <h5><strong>Chapters .</strong></h5>
    <?php $__currentLoopData = $training['chapter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    	<?php if($key < $finish_chapter): ?>
    		<div style="padding-bottom: 10px;">
    			<?php if($chapter->category == 0): ?>
                	<a href="<?php echo e(url('/material', $chapter->id)); ?>" class="btn btn-default" style="width: 100%;text-align: left;"><?php echo e($chapter->chapter_name); ?></a>
                <?php else: ?>
                	<a href="<?php echo e(url('/test', $chapter->id)); ?>" class="btn btn-default" style="width: 100%;text-align: left;"><?php echo e($chapter->chapter_name); ?></a>
                <?php endif; ?>
            </div>
    	<?php else: ?>
    		<div style="padding-bottom: 10px;">
                <a class="btn btn-default" style="width: 100%;text-align: left;" disabled="true"><?php echo e($chapter->chapter_name); ?></a>
            </div>
    	<?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    
    
    <div class="text-center">
      <a href="#" class="btn btn-success">Finish Training</a>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>