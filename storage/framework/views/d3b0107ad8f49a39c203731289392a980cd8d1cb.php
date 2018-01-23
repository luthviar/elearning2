<?php $__env->startSection('content_training'); ?>


<div class="container" style="padding-bottom: 100px;">
  <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="text-center">
          <h1><?php echo e($chapter->chapter_name); ?></h1>
          <p><?php echo html_entity_decode($chapter['material']->description); ?></p>
          <h4>Attachments :</h4>
          <?php $__currentLoopData = $chapter['material']['files_material']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div style="padding-bottom: 10px;">
            
                
               
                       
                
               
              
            
              <a
                  class="btn btn-default btn-block btn-lg"
                  onclick="window.open('<?php echo e(URL::asset($file->url)); ?>',width='+screen.availWidth+',
                          height='+screen.availHeight')"
                  style="cursor:pointer; text-decoration: none;"

              >
                  <?php echo e($file->name); ?> <br/>
                  
              </a>
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <?php if($is_finish->is_finish == 1): ?>
                <a
                        
                        onclick="window.open('<?php echo e(url('/finish_chapter',$chapter->id)); ?>','_self')"
                        class="btn color-std">
                    Next Chapter
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
              <?php else: ?>
                <a
                        
                        onclick="window.open('<?php echo e(url('/finish_chapter',$chapter->id)); ?>','_self')"
                        class="btn color-std">
                    Finish this chapter
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            <?php endif; ?>


        </div>
      </div>
  </div>
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        function openPDF() {
            var myWindow = window.open('', 'MsgWindow', 'width='+screen.availWidth+',height='+screen.availHeight);
            var coba = 'satu';
            myWindow.document.write("<iframe id='iframe' src ='<?php echo e(URL::asset($file->url)); ?>' width='90%' height='90%' allowfullscreen webkitallowfullscreen></iframe>");

            myWindow.document.getElementById('iframe').textContent().removeChild(document.getElementById('download'));
        }
//        $('#iframe').ready(function() {
//            setTimeout(function() {
//                $('#iframe').contents().find('#download').remove();
//            }, 100);
//        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('user.training.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>