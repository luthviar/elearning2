<?php $__env->startSection('content'); ?>

<div class="container text-center">
	<iframe id="iframe"
			src = "<?php echo e(URL::to('/ViewerJS/index.html#../files/situs.pdf')); ?>"
			width='100%'
			height='600'
			allowfullscreen webkitallowfullscreen>
	</iframe>

	<a href="<?php echo e(URL::previous()); ?>" class="btn btn-success">back</a>
</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>