<p class="border-panel-title-wrap">
    <span class="panel-title-text">Schedule</span>
</p>
<div class="row">
    <div class="col-md-12 clearfix">
        <ul>
          <?php $__currentLoopData = $schedule; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sched): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>- <?php echo e($sched->modul_name); ?> . <?php echo e(date('j M Y',strtotime($sched->date))); ?> . <?php echo e(date('H:i',strtotime($sched->time))); ?></li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </ul>
    </div>
</div>
