<?php $__env->startSection('content_training'); ?>


<div class="container" style="padding-bottom: 100px;">
  <div class="row">
    <div class="text-center">
      <h1><?php echo e($chapter->chapter_name); ?></h1>
      <p><?php echo e($chapter['material']->description); ?></p>
      <h4>Attachments :</h4>
      <?php $__currentLoopData = $chapter['material']['files_material']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <div style="padding-bottom: 10px;">
        <a href="/file" class="btn btn-default" style="width: 100%;">
          <?php echo e($file->name); ?>

        </a>
      </div>
      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <a href="<?php echo e(url('/test', $chapter->id)); ?>" class="btn btn-success">Finish this chapter</a>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.training.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>