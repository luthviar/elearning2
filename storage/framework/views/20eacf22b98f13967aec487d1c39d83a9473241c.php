<?php $__env->startSection('content'); ?>

<div class="container" style="padding-top: 20px;">
	<div class="text-center" style="border-bottom: 1px solid green;">
		<h3>Review <?php echo e($chapter->chapter_name); ?></h3>	
	</div>
	<div style="padding-top: 5px; ">
		<div class="col-xs-12 col-md-4 text-center" style="border: 1px solid green; ">
			<h3><strong>Your Score</strong></h3>
			<h1 class="green_color" style="font-size: 60px;"><?php echo e($record['skor']); ?></h1>
		</div>
		<div class="col-xs-12 col-md-4 text-center" style="border: 1px solid green; ">
			<h3><strong>Total Question</strong></h3>
			<h1 class="green_color" style="font-size: 60px;"><?php echo e($record['total_question']); ?></h1>
		</div>
		<div class="col-xs-12 col-md-4 text-center" style="border: 1px solid green; ">
			<h3><strong>True Answer</strong></h3>
			<h1 class="green_color" style="font-size: 60px;"><?php echo e($record['true_answer']); ?></h1>
		</div>
	</div>
	<div class="text-center">
		<a href="<?php echo e(url('/get_training',$chapter->id_module)); ?>" class="btn btn-success">finish review</a>	
	</div>

	
</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>