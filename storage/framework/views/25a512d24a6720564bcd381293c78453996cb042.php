<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Chapter Training
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo e(url('/training')); ?>">Training</a></li>
        <li class="active">Add Chapter Training</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add Chapter</h3>
            </div>
            <div class="box-body">

                 <form action="<?php echo e(url('/edit_chapter_submit')); ?>" method="post">
                 <?php echo e(csrf_field()); ?>

                  <input type="hidden" name="id_chapter" value="<?php echo e($chapter->id); ?>">
                  <!-- Title -->
                  <div class="form-group col-md-6">
                    <label for="title">Chapter Name</label>
                    <input type="text" class="form-control" name="chapter_name" value="<?php echo e($chapter->chapter_name); ?>" id="title" placeholder="Training title">
                  </div>
                    <!-- select -->
                  <div class="form-group col-md-6">
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
                    <!-- Textarea -->
                  <div class="form-group">
                      <label>Chapter Description</label>
                      <?php if($chapter->category == 0): ?>
                      <textarea class="textarea" id="content" name="description" value="<?php echo e($chapter['material']->description); ?>" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                        <?php else: ?>
                        <textarea class="textarea" id="content" name="description" value="<?php echo e($chapter['test']->description); ?>" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo e($chapter['test']->description); ?></textarea>
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
      $('#add_test_form').addClass('hidden');
      $('#add_material_form').removeClass('hidden');
    } else {
      // test form load
      $('#add_test_form').removeClass('hidden');
      $('#add_material_form').addClass('hidden');
    }
  });
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>