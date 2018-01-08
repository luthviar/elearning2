<?php $__env->startSection('content_training'); ?>

<div class="container" style="padding-top: 20px;">
	<div class="row text-center" style="border-bottom: 1px solid green;">
		<h3>Review <?php echo e($chapter->chapter_name); ?></h3>	
	</div>
	<div class="row" style="padding-top: 5px; ">
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

	<div class="row" style="padding-top: 50px;">
		<div class="text-center" >
			<a style="padding-top: 10px;" href="<?php echo e(url('/get_chapter',$chapter->id)); ?>" class="btn color-std">Finish Review</a>
		</div>
	</div>
</div>


<?php $__env->stopSection(); ?>


<?php echo $__env->make('user.training.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>