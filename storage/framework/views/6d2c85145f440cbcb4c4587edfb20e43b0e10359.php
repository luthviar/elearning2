<p class="border-panel-title-wrap">
    <span class="panel-title-text">Links</span>
</p>
<div class="row">
    <div class="col-md-12 clearfix">
        <?php $__currentLoopData = $link; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aero_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="<?php echo e($aero_link->url); ?>"
           class="btn btn-lg <?php echo e($aero_link->color); ?>"
           style="margin:5px 1px"
           data-toggle="tooltip"
           data-placement="top"
           title="<?php echo e($aero_link->detail_url); ?>	(<?php echo e($aero_link->url); ?>)"
           target="_blank"
        >

            <?php echo e($aero_link->name); ?>

        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <a href="https://oms.aerofood.co.id"
           class="btn btn-lg red"
           style="margin:5px 1px"
           data-toggle="tooltip"
           data-placement="top"
           title="Operation Monitoring System	(oms.aerofood.co.id)"
           target="_blank"
        >
            IMS
        </a>
        <a href="https://oms.aerofood.co.id"
           class="btn btn-lg blue"
           style="margin:5px 1px"
           data-toggle="tooltip"
           data-placement="top"
           title="Operation Monitoring System	(oms.aerofood.co.id)"
           target="_blank"
        >
            GLP-ICGB
        </a>
        <a href="https://oms.aerofood.co.id"
           class="btn btn-lg green"
           style="margin:5px 1px"
           data-toggle="tooltip"
           data-placement="top"
           title="Operation Monitoring System	(oms.aerofood.co.id)"
           target="_blank"
        >
            Proline
        </a>
        <a href="#" class="btn btn-lg yellow" style="margin:5px 1px">
            eProc
        </a>
        <a href="#" class="btn btn-lg purple" style="margin:5px 1px">
            eLearning
        </a>
        <a href="#" class="btn btn-lg green" style="margin:5px 1px">
            eRecruitment
        </a>
        <a href="#" class="btn btn-lg dark" style="margin:5px 1px">
            Simpreman
        </a>
        <a href="#" class="btn btn-lg purple" style="margin:5px 1px">
            ePireq
        </a>
        <a href="#" class="btn btn-lg green" style="margin:5px 1px">
            eBudgeting
        </a>
        <a href="#" class="btn btn-lg blue" style="margin:5px 1px">
            SOB
        </a>
    </div>
</div>
