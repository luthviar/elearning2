<p class="border-panel-title-wrap">
    <span class="panel-title-text">Recent Training Schedule</span>
</p>
<div class="row">
    <div class="col-md-12 clearfix">
        <div class="list-group">
          <?php $__currentLoopData = Session::get('schedule'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sched): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(url(action('TrainingController@get_trainings',$sched->id))); ?>" class="list-group-item">
                <h4 class="list-group-item-heading">
                    <?php echo e($sched->modul_name); ?>

                </h4>
                <p class="list-group-item-text">
                    <strong>Start at:</strong> <?php echo e(date('j M Y',strtotime($sched->date))); ?>

                    -
                    <?php echo e(date('H:i',strtotime($sched->time))); ?>

                </p>
            </a>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</div>
