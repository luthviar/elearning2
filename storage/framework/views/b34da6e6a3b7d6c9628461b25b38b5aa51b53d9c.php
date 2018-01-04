<?php $__env->startSection('content'); ?>

<!-- ********************************************** -->
<!--                  POST                          -->
<!-- ********************************************** -->

  <div class="row" style="padding-top: 20px;">
    <div class="container">
      <!-- News Content and Comments-->
      <div class="col-xs-12 col-sm-6 col-md-8" style="padding-bottom: 20px;">
        <!-- CONTENT -->
        <div id="news_content">
          <div class="col-xs-12 col-sm-6 col-md-4">
            <img src="<?php echo e(URL::asset('gambar.png')); ?>" style="width: 100%; height: 150px;">
          </div>
          <div class="col-xs-12 col-sm-6 col-md-8">
            <h3><strong><?php echo e($news->title); ?></strong></h3>
            <h6><strong>Created at <?php echo e($news->created_at); ?></strong> . 10x seen by user</h6>  
          </div>
          
          <p><?php echo e($news->content); ?></p>

          <!-- Attachments -->
          <div>
            <h5><strong>Attachments : </strong></h5>
            <?php if( !$news['attachments'] instanceof Traversable ): ?>

              <?php echo e($news['attachments']); ?>


            <?php else: ?>

              <?php $__currentLoopData = $news['attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <h6 style="text-indent: 20px;">* <?php echo e($attachment->attachment_name); ?></h6>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php endif; ?>
          </div>
        </div>

        <!-- COMMENTS -->
        <div id="news_comments">
          <h3><strong class="green_color">Comments</strong></h3>
          <br>
          <?php if( !$news['comments'] instanceof Traversable ): ?>
              <?php echo e($news['comments']); ?>

          <?php else: ?>
            <?php $__currentLoopData = $news['comments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="media">
                <div class="media-left">
                  <a href="#">
                    <img class="media-object img-circle" src="<?php echo e(URL::asset('gambar.png')); ?>" alt="..." style="width: 100px; border : 1px solid green;">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading"><?php echo e($comment->title); ?></h4>
                  <h6>Alexander John, at <?php echo e($comment->created_at); ?> </h6>
                  <p><?php echo e($comment->content); ?></p>
                  <div>
                    <h6><strong>Attachments :</strong></h6>
                    <?php if( !$comment['attachments'] instanceof Traversable ): ?>
                      $comment['attachments']
                    <?php else: ?>
                      <?php $__currentLoopData = $comment['attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h6 style="text-indent: 20px;">* <?php echo e($attachment->attachment_name); ?></h6>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>

          
          <?php if(auth()->guard()->guest()): ?>
          <?php else: ?>
            <div style="padding-top: 20px;">
              <input type="text" class="form-control" value="[Re]: <?php echo e($news->title); ?>">
              <textarea class="form-control" rows="3"></textarea><br>
              <button class="btn btn-default" type="submit">Button</button>
            </div>
          <?php endif; ?>
        </div>
      </div>
      
      <!-- List Last News Post -->
      <div class="col-xs-12 col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading"><strong class="green_color">OTHER NEWS</strong></div>
          <div class="panel-body">
            <ul>
              <?php $__currentLoopData = $last_news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <li><a href="<?php echo e(URL('/get_news', $news->id)); ?>"> <?php echo e($news->title); ?></a></li>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>