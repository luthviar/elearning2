<?php $__env->startSection('content'); ?>

<div class="container text-center" style="padding-top: 100px; padding-bottom: 100px;">
	<h3><?php echo e($error); ?></h3>

	<a href="<?php echo e(URL::previous()); ?>" class="btn btn-success">back</a>
</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>