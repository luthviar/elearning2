<?php $__env->startSection('page-name'); ?>
    <a href="<?php echo e(url(action('TrainingController@manage_chapter',$chapter->id))); ?>">
        <i class="fa fa-arrow-left"></i>
    </a>
    Edit Chapter Training
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">
                  
              </h3>
            </div>
            <div class="box-body">

                 <form action="<?php echo e(url(action('TrainingController@edit_chapter_submit'))); ?>" method="post">
                 <?php echo e(csrf_field()); ?>

                  <input type="hidden" name="id_chapter" value="<?php echo e($chapter->id); ?>">
                  <!-- Title -->
                  <div class="col-md-12">
                  <div class="form-group col-md-4">
                    <label for="title">Chapter Name</label>
                    <input type="text" class="form-control" name="chapter_name" value="<?php echo e($chapter->chapter_name); ?>" id="title" placeholder="Training title">
                  </div>
                    <!-- select -->
                  <div class="form-group col-md-4">
                    <label>Chapter Type</label>
                    <select class="form-control" id="add_chapter_type" name="category">
                      <?php if($chapter->category == 0): ?>
                      <option value="0" selected="true">Material</option>
                      <option value="1">Test</option>
                      <?php else: ?>
                      <option value="0">Material</option>
                      <option value="1" selected="true">Test</option>
                      <?php endif; ?>
                    </select>
                  </div>
                  <?php if($chapter->category == 0): ?>
                  <!-- Title -->
                  <div class="form-group col-md-4 hidden" id="test_time">
                    <label for="time">Test Time</label>
                    <input type="text" class="form-control" name="time" id="time" placeholder="in minutes">
                  </div>
                  </div>
                  <?php else: ?>
                  <!-- Title -->
                  <div class="form-group col-md-4" id="test_time">
                    <label for="time">Test Time</label>
                    <input type="text" class="form-control" value="<?php echo e($chapter['test']->time); ?>" name="time" id="time" placeholder="in minutes">
                  </div>
                  </div>
                  <?php endif; ?>
                    <!-- Textarea -->
                  <div class="form-group">
                      <label>Chapter Description</label>
                      <?php if($chapter->category == 0): ?>
                      <textarea class="textarea" id="summernote" name="description"
                                placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo e($chapter['material']->description); ?></textarea>
                        <?php else: ?>
                        <textarea class="textarea" id="summernote" name="description"
                                  placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo e($chapter['test']->description); ?></textarea>
                        <?php endif; ?>
                  </div>
                    
                  <div class="col-md-12 text-center">
                   <input type="submit" name="submit" class="btn btn-default">
                  </div>
                  </form> 

                    </div>
                    <!-- /.box-body -->
                  </div>

            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->

        </div>

    </div>
    


    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  $('#add_chapter_type').on('input', function(){
      var chapter_type = $('#add_chapter_type').val();
    if (chapter_type == 0) {
      // material form load
      $('#test_time').addClass('hidden');
    } else {
      // test form load
      $('#test_time').removeClass('hidden');
    }
  });
</script>
</script>
<script type="text/javascript">
  //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });


</script>


<script type="text/javascript">
$(document).ready(function(){
  $('#title').on('input', function(){ 
    var input = $('#title').val();
    $('#preview_news_title').html(input);

   });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('#content').on('input', function(){ 
    var input = $('#content').val();
    $('#preview_news_content').html(input);

   });
});
</script>

<?php echo $__env->make('admin.layouts.summernote', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>