<?php $__env->startSection('content'); ?>

<div class="container" style="padding-top: 100px; padding-bottom: 100px;">
  <div class="row">

      
    <div class="text-center">
      <h1><strong><?php echo e($training->modul_name); ?></strong></h1>
      <h5>Contain <?php echo e(count($training['chapter'])); ?> chapter . 1271 user finish this course</h5>
      <p><?php echo e($training['description']); ?></p>
    </div>


    
        <div class="col-lg-12" style="border-top: 1px solid #13B795;">
          <div class="tabs tabs-style-underline">
              <nav>
                  <ul>
                      <li class="tab-current">
                          <a href="#" class="icon">
                              <span>
                                  <i class="glyphicon glyphicon-th-list"></i>
                                   List of Chapters
                              </span>
                          </a>
                      </li>
                      <?php $__currentLoopData = $training['chapter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($key < $finish_chapter): ?>

                                  <?php if($chapter->category == 0): ?>
                                      <li class="">
                                          <a href="<?php echo e(url('/material', $chapter->id)); ?>" class="icon">

                                              <span>
                                                  <i class="glyphicon glyphicon-book"></i>
                                                   <?php echo e($chapter->chapter_name); ?>

                                              </span>
                                          </a>
                                      </li>

                                  <?php else: ?>
                                      <li>
                                          <a href="<?php echo e(url('/test', $chapter->id)); ?>"
                                             class="icon"
                                             style="margin-right: 0px;"
                                          >
                                              <span>
                                                  <i class="glyphicon glyphicon-pencil"></i>
                                                   <?php echo e($chapter->chapter_name); ?>

                                              </span>
                                          </a>
                                      </li>

                                  <?php endif; ?>

                          <?php else: ?>
                              <li>
                                  <a href="#" class="icon">
                                      <span>
                                          <i class="glyphicon glyphicon-pencil"></i>
                                          <?php echo e($chapter->chapter_name); ?>

                                      </span>
                                  </a>
                              </li>

                          <?php endif; ?>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </ul>
              </nav>
              <div class="content-wrap">
                  <?php $__currentLoopData = $training['chapter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <?php if($key < $finish_chapter): ?>
                          <div style="padding-bottom: 10px;">
                              <?php if($chapter->category == 0): ?>
                                  <a href="<?php echo e(url('/material', $chapter->id)); ?>" class="btn btn-default" style="width: 100%;text-align: left;"><?php echo e($chapter->chapter_name); ?></a>
                              <?php else: ?>
                                  <a href="<?php echo e(url('/test', $chapter->id)); ?>"
                                     class="btn btn-default"
                                     style="width: 100%;text-align: left;"><?php echo e($chapter->chapter_name); ?></a>
                              <?php endif; ?>
                          </div>
                      <?php else: ?>
                          <div style="padding-bottom: 10px;">
                              <a class="btn btn-default" style="width: 100%;text-align: left;" disabled="true"><?php echo e($chapter->chapter_name); ?></a>
                          </div>
                      <?php endif; ?>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

              </div><!-- /content -->
          </div><!-- /tabs -->
      </div>


    
    
    <div class="text-center">
      <a href="#" class="btn btn-success">Finish Training</a>
    </div>
  </div>
</div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>