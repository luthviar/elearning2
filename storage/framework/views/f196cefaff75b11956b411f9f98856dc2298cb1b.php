<ul>
    <li class="<?php echo e(Request::is('get_training/*') ? 'tab-current' : ''); ?>">
        <a
            href="<?php echo e(url('get_training/'.Session::get('training')->id)); ?>"
            class="icon">
              <span>
                  <i class="glyphicon glyphicon-th-list"></i>
                   List of Chapters
              </span>
        </a>
    </li>


    <?php $__currentLoopData = Session::get('training')['chapter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if($key < Session::get('finish_chapter')): ?>

            <?php if($chapter->category == 0): ?>
                <li class="<?php echo e(Request::is('material/*') ? 'tab-current' : ''); ?>">
                    <a
                        
                        onclick="window.open('<?php echo e(url('/material',$chapter->id)); ?>','_self')"
                        style="cursor:pointer;"
                        class="icon">
                      <span>
                          <i class="glyphicon glyphicon-book"></i>
                          <?php echo e($chapter->chapter_name); ?>

                      </span>
                    </a>
                </li>

            <?php else: ?>

                <?php if(Request::is('review_test/*')): ?>
                <li class="<?php echo e(Request::is('review_test/'.$chapter->id) ? 'tab-current' : ''); ?>">
                <?php else: ?>
                <li class="<?php echo e(Request::is('test/'.$chapter->id) ? 'tab-current' : ''); ?>">
                <?php endif; ?>
                    <?php if(Session::get('record') == 'yes'): ?>
                    <a
                        onclick="window.open('<?php echo e(url('/test',$chapter->id)); ?>','_self')"
                        target="_self"
                        class="icon"
                        style="margin-right: 0px; cursor: pointer;"
                    >
                        
                        <?php elseif(Session::get('record') != 'yes'): ?>
                    <a
                        onclick="window.open('<?php echo e(url('/test',$chapter->id)); ?>','_self')"
                        target="_self"
                        class="icon"
                        style="margin-right: 0px; cursor: pointer;"
                        data-toggle="modal" data-target="#TestStart"
                    >
                        <?php endif; ?>
                      <span>
                          <i class="glyphicon glyphicon-pencil"></i>
                          <?php echo e($chapter->chapter_name); ?>

                      </span>
                    </a>
                </li>



            <?php endif; ?>

        <?php else: ?>
            <li class="<?php echo e(Request::is('test/*') || Request::is('material/*') || Request::is('review_test/*') ? 'tab-current' : ''); ?>">
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