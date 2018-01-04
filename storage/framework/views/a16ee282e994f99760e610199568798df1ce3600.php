<?php $__env->startSection('content'); ?>

<div class="row" style="padding-top: 20px">
  <div class="container">
    <div class="text-center">
      <h3><?php echo e($chapter->chapter_name); ?></h3>
      <p><?php echo e($chapter['material']->description); ?></p>
      <h4>Attachments :</h4>
      <?php $__currentLoopData = $chapter['material']['files_material']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div style="padding-bottom: 10px;"><a href="/file" class="btn btn-default" style="width: 100%;"><?php echo e($file->name); ?></a></div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e(url('/finish_chapter', $chapter->id)); ?>" class="btn btn-success">Finish this chapter</a>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>