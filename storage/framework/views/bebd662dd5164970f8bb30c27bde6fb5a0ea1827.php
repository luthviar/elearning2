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

            <form action="<?php echo e(url(action('TrainingController@edit_training_submit'))); ?>" method="post">
              <?php echo e(csrf_field()); ?>


              <input type="hidden" name="id_module" value="<?php echo e($module->id); ?>">
            
              <!-- Title -->
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="modul_name" value="<?php echo e($module->modul_name); ?>" placeholder="Training title">
              </div>


              <!-- select -->
                <div class="form-group col-md-4">
                  <label>Training Parent</label>
                  <select class="form-control" name="id_parent" id="parent">
                    <?php $__currentLoopData = $parent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $par): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($par->id == $module->id_parent): ?>
                    <option value="<?php echo e($par->id); ?>" selected="true"><?php echo e($par->modul_name); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($par->id); ?>"><?php echo e($par->modul_name); ?></option>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>

             <!-- Date -->
              <div class="form-group col-md-4">
                <label>Training Date:</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="date" value="<?php echo e($module->date); ?>" class="form-control pull-right" id="datepicker" dateFormat="yy-mm-dd">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- time Picker -->
              <div class="bootstrap-timepicker col-md-4">
                <div class="form-group">
                  <label>Training Start:</label>

                  <div class="input-group">
                    <input type="text" name="time" value="<?php echo e($module->time); ?>" class="form-control" placeholder="00:00:00 -- 24 hours format">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>

              <!-- select -->
              <div class="col-md-12">
              <?php if($module->id_parent == 3): ?>
                <div class="form-group col-md-4" id="department">
              <?php else: ?>
                <div class="form-group col-md-4 hidden" id="department">
              <?php endif; ?>
                  <label>Department</label>
                  <select class="form-control" name="id_department" >
                    <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($dept->id == $module->id_department): ?>
                    <option value="<?php echo e($dept->id); ?>" selected="true"><?php echo e($dept->department_name); ?></option>
                    <?php else: ?>
                    <option value="<?php echo e($dept->id); ?>"><?php echo e($dept->department_name); ?></option>
                    <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  </select>
                </div>
                </div>

              <!-- Textarea -->
              <div class="form-group">
                  <label>Training Overview</label>
                  <textarea class="textarea" id="summernote" name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"><?php echo e($module->description); ?></textarea>
              </div>

              <h5><strong>Trainer</strong></h5>
              <button class="add_field_button btn btn-default">Add More Trainer</button>
              <div class="input_fields_wrap col-md-12" style="padding-top: 10px;">
              <?php $__currentLoopData = $trainer; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $trains): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($key == 0): ?>
              <div class="col-md-12" style="padding-bottom: 5px;">
                <h6>Trainer Name</h6>
                <input type="text" class="form-control" style="width: 50%;" value="<?php echo e($trains->trainer_name); ?>" name="trainer_name[]">
                <h6>Trainer Info</h6>
                <input type="text" class="form-control" style="width: 50%;" value="<?php echo e($trains->trainer_info); ?>" name="trainer_info[]">
                
              </div>
              <?php else: ?>
              <div class="col-md-12" style="padding-bottom: 5px;">
                <h6>Trainer Name</h6>
                <input type="text" class="form-control" style="width: 50%;" value="<?php echo e($trains->trainer_name); ?>" name="trainer_name[]">
                <h6>Trainer Info</h6>
                <input type="text" class="form-control" style="width: 50%;" value="<?php echo e($trains->trainer_info); ?>" name="trainer_info[]"><a href="#" class="remove_field">Remove</a>
                
              </div>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </div>

              <div class="row text-center">
                <button class="btn btn-success">Submit</button>
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
  //Date picker
    $('#datepicker').datepicker({
      
      format: 'yyyy-mm-dd',
    });
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
      timeFormat: 'HH:i',
    });


</script>

<<!-- script src="<?php echo e(URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
<script>

  $(function () {
    
    //bootstrap WYSIHTML5 - text editor
  var editor =  $(".textarea").wysihtml5({
      toolbar: {
        "font-styles": true, // Font styling, e.g. h1, h2, etc.
        "emphasis": true, // Italics, bold, etc.
        "lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
        "html": false, // Button which allows you to edit the generated HTML.
        "link": true, // Button to insert a link.
        "image": false, // Button to insert an image.
        "color": true, // Button to change color of font
        "blockquote": false, // Blockquote
        
      }
    });

  
  
  
  
  });

</script> -->

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
  $('#parent').on('input',function(){
    var $input = $('#parent').val();
    if ($input == 3) {
      $('#department').removeClass('hidden');
    }else{
      $('#department').addClass('hidden');
    }
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
            $(wrapper).append('<div class="col-md-12" style="padding-bottom: 5px;"><h6>Trainer Name</h6><input type="text" class="form-control" style="width: 50%;" placeholder="name.." name="trainer_name[]"><h6>Trainer Info</h6><input type="text" class="form-control" style="width: 50%;" placeholder="info.." name="trainer_info[]"><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
    <?php echo $__env->make('admin.layouts.summernote', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>