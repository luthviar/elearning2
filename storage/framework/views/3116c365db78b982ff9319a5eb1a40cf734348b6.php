<?php $__env->startSection('content'); ?>

<!-- ********************************************** -->
<!--                  SLIDER                        -->
<!-- ********************************************** -->

  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <?php for( $i = 0 ;  $i < count($sliders) ; $i++ ): ?>
            <?php if( $i == 0 ): ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo e($i); ?>" class="active"></li>
            <?php else: ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo e($i); ?>"></li>
            <?php endif; ?>
        <?php endfor; ?>
    </ol>
    <div class="carousel-inner" role="listbox">
        <?php for( $i = 0 ;  $i < count($sliders) ; $i++ ): ?>
            <?php if( $i == 0 ): ?>
                <div class="item active">
                    <img data-src="holder.js/900x500/auto/#777:#555/text:First slide" alt="First slide" >
                    <div class="carousel-caption">
                        <h2><?php echo e($sliders[$i]->title); ?></h2>
                        <p><?php echo e($sliders[$i]->second_title); ?></p>
                    </div>
                </div>
            <?php else: ?>
                <li data-target="#carousel-example-generic" data-slide-to="<?php echo e($i); ?>"></li>
            <?php endif; ?>
        <?php endfor; ?>
    </div>
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


<!-- ********************************************** -->
<!--                  News                          -->
<!-- ********************************************** -->

    <div class="row">
      <div class="container">
        <div class="content_head">
          <h4> <strong>News</strong></h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="container">
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>