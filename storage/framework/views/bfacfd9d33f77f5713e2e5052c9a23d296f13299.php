<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Chapter Training
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo e(url('/personnel')); ?>">Training</a></li>
        <li class="active">Manage Chapter Training</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Edit Question</h3>
            </div>
            <div class="box-body">
                 <form action="<?php echo e(url('edit_question_submit')); ?>" method="post">
                   <?php echo e(csrf_field()); ?>

                 
                  <input type="hidden" name="question_id" value="<?php echo e($question->id); ?>">
                 <div class="form-group">
                    <label>Question</label>
                    <textarea class="textarea" name="question_text" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo e($question->question_text); ?></textarea>
                </div>
                
                  <h5><strong>Options</strong></h5>
                  <button class="add_field_button btn btn-default">Add More Fields</button>
                  <div class="input_fields_wrap col-md-12" style="padding-top: 10px;">
                    <?php $__currentLoopData = $question['option']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($key < 2): ?>
                    <div class="col-md-12" style="padding-bottom: 5px;"><input type="text" class="form-control" value="<?php echo e($option->option_text); ?>" style="width: 80%;" placeholder="input option" name="option[]"></div>
                    <?php else: ?>
                    <div class="col-md-12" style="padding-bottom: 5px;"><input type="text" class="form-control" value="<?php echo e($option->option_text); ?>" style="width: 80%;" placeholder="input option" name="option[]"><a href="#" class="remove_field">Remove</a></div>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </div>

                <div class="col-md-12 text-center">
                 <input type="submit" name="submit" class="btn btn-default">
                </div>

                </form>
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

<script src="<?php echo e(URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>

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
<script type="text/javascript">
  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="col-md-12" style="padding-bottom: 5px;"><input type="text" style="width: 80%;" class="form-control" placeholder="input option" name="option[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>