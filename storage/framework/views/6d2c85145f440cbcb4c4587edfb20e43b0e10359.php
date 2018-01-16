<p class="border-panel-title-wrap">
    <span class="panel-title-text">Links</span>
</p>
<div class="row">
    <div class="col-md-12 clearfix">
        <?php $__currentLoopData = Session::get('link'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aero_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="http://<?php echo e($aero_link->url); ?>"
           class="btn btn-lg <?php echo e($aero_link->color); ?>"
           style="margin:5px 1px"
           data-toggle="tooltip"
           data-placement="top"
           title="<?php echo e($aero_link->detail_url); ?>

                   (<?php echo e($aero_link->url); ?>)
                   (<?php echo e($aero_link->status); ?>)"
           target="_blank"
        >

            <?php echo e($aero_link->name); ?>

        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    </div>
</div>
