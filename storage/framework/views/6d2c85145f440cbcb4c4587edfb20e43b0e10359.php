<div class="block-title2" style="background-color:transparent !important; border-bottom:none !important; border-top:none !important; padding-top:0px !important;">
    <div style="font-size:28px; font-weight:300; text-align:center;">LINK TO AEROFOOD ACS PROJECT</div>
    <div class="title-icon2"><i class="fa fa-globe fa-2x" style="color:#415FC3; margin-top:10px;;"></i></div>
</div>
<div class="col-md-12">
    <div class="carousel carousel-showtwomoveone slide" id="carou-link">
        <div class="carousel-inner">
            <?php $n = 0?>
                <?php if(empty(Session::get('link')) == false): ?>
            <?php $__currentLoopData = Session::get('link'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aero_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($n == 0): ?>
                <?php $n = 1 ?>
                <div class="item active">
                <?php else: ?>
                <?php $n++; ?>
                <div class="item">
                <?php endif; ?>
                    <div class="col-md-6">
                        <a href="http://<?php echo e($aero_link->url); ?>" style="text-decoration:none;">
                            <div style="border-top:1px; border-right:1px; border-bottom:1px; border-left:1px; border-style:solid; border-color:#ccc; background-color:#ffffff; padding:1em 1.5em; position:relative; border-radius:5px !important; height:140px; max-height:140px; position: relative;">
                                <div class="va-table">
                                    <div class="va-middle">
                                        <h3 style="margin:0; color:#ccc; text-transform:uppercase;"><b><?php echo e($aero_link->name); ?></b></h3>
                                    </div>
                                </div>
                                <div class="va-table">
                                    <div class="va-middle" style="height:40px;">
                                        <h5 style="margin:0; color:#000;"><?php echo e($aero_link->detail_url); ?></h5>
                                    </div>
                                </div>
                                <div class="va-table">
                                    <div class="va-middle"><i class="fa fa-link"></i>&nbsp;&nbsp;</div>
                                    <div class="va-middle"><?php echo e($aero_link->url); ?></div>
                                </div>
                                <div style="position: absolute; bottom:1em; left:1.5em;">
                                    <h5 style="margin:0; color:#000;"><div class="badge badge-primary">&nbsp;&nbsp;<?php echo e($aero_link->status); ?>&nbsp;&nbsp;</div></h5>
                                </div>
                                <div style="position: absolute; top:-1px; right:-1px;">
                                    <div style="margin:0; color:#FFF; padding:3px 7px; font-size:12px; background-color:#fcb322; font-weight:bold; border-radius:0px 5px 0px 0px !important;"><?php echo e($n); ?></div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php else: ?>
                      <h4 class="text-center">You Should Login First</h4>
                    <?php endif; ?>
            </div>

            <a class="left carousel-control" href="#carou-link" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
            <a class="right carousel-control" href="#carou-link" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
        
    </div>
</div>



<!--<p class="border-panel-title-wrap">
    <span class="panel-title-text">Links</span>
</p>
<div class="row">
    <div class="col-md-12 clearfix">
    <?php if(empty(Session::get('schedule')) == false): ?>
        <?php $__currentLoopData = Session::get('link'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aero_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="http://<?php echo e($aero_link->url); ?>" class="btn btn-lg <?php echo e($aero_link->color); ?>" style="margin:5px 1px" data-toggle="tooltip" data-placement="top" title="<?php echo e($aero_link->detail_url); ?>

                   (<?php echo e($aero_link->url); ?>)
                   (<?php echo e($aero_link->status); ?>)" target="_blank">

            <?php echo e($aero_link->name); ?>

        </a> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>

    </div>
</div>-->
