<div class="block-title2" style="background-color:transparent !important; border-bottom:none !important; border-top:none !important; padding-top:0px !important;">
    <div style="font-size:28px; font-weight:300; text-align:center;">RECENT TRAINING SCHEDULE</div>
    <div class="title-icon2"><i class="fa fa-calendar fa-2x" style="color:#415FC3; margin-top:10px;;"></i></div>
</div>
<div class="col-md-12">
    <div style="width:80%; margin:0 auto;">
        <div class="list-group" style="position:relative;">
         <?php $n = 0?>
             <?php if(empty(Session::get('schedule')) == false): ?>
          <?php $__currentLoopData = Session::get('schedule'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sched): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
           <?php $n++; ?>
            <a href="<?php echo e(url(action('TrainingController@get_trainings',$sched->id))); ?>" target="_blank" class="list-group-item">
                <h4 class="list-group-item-heading">
                    <?php echo e($sched->modul_name); ?>

                </h4>
                <p class="list-group-item-text">
                    <strong>Start at:</strong> <?php echo e(date('j M Y',strtotime($sched->date))); ?>

                    -
                    <?php echo e(date('H:i',strtotime($sched->time))); ?>

                </p>
                <div style="position: absolute; top:0; right:0;">
                <div style="margin:0; color:#FFF; padding:3px 7px; font-size:12px; background-color:#fcb322; font-weight:bold;"><?php echo e($n); ?></div>
            </div>
            </a>
            
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php else: ?>
                 <h4 class="text-center">You Should Login First</h4>
                 <?php endif; ?>
        </div>
    </div>
</div>

<!--
<p class="border-panel-title-wrap">
    <span class="panel-title-text">Recent Training Schedule</span>
</p>
<div class="row">
    <div class="col-md-12 clearfix">
        <div class="list-group">
        <?php if(empty(Session::get('schedule')) == false): ?>
          <?php $__currentLoopData = Session::get('schedule'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sched): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <a href="<?php echo e(url(action('TrainingController@get_trainings',$sched->id))); ?>" target="_blank" class="list-group-item">
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
        <?php endif; ?>
        </div>

    </div>
</div>
-->
