<?php $__env->startSection('content'); ?>


<!-- ********************************************** -->
<!--                  News                          -->
<!-- ********************************************** -->

    <div class="row">
      <div class="container">
        <div class="content">
            <?php $__currentLoopData = $newses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-sm-4 news_padding">
                  <img src="assets/img/sass-less.png" alt="Sass and Less support" class="img-responsive news_image">
                  <a href="<?php echo e(URL ('/get_news', $news->id)); ?>"><h4><?php echo e($news->title); ?></h4></a>
                  <h6><strong>Created at <?php echo e($news->created_at); ?></strong></h6>
                  <p><?php echo e($news->content); ?></p>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            
         </div>
      </div>
    </div>

    <div class="row">
      <div class="container">
        <div style="text-align: center;">
          <?php echo e($newses->links()); ?>

        </div>
      </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>