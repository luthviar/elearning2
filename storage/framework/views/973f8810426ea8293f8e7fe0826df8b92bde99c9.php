<?php $__env->startSection('content'); ?>

    <div class="container" style="padding-top: 100px; padding-bottom: 100px;">
        <div class="row">

            
            <div class="text-center">
                <h1><strong><?php echo e(Session::get('training')->modul_name); ?></strong></h1>
                <h5>Contain <?php echo e(count(Session::get('training')['chapter'])); ?> chapter . 1271 user finish this course</h5>
                <p><?php echo e(Session::get('training')['description']); ?></p>
            </div>


            <div class="col-lg-12" style="border-top: 1px solid #13B795;">
                <div class="tabs tabs-style-underline">
                    <nav>
                        <?php echo $__env->make('user.training.layouts.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </nav>
                    <div class="content-wrap">
                        <?php echo $__env->yieldContent('content_training'); ?>


                    </div><!-- /content -->
                </div><!-- /tabs -->
            </div>

            
                
            
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>