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
              <h3 class="box-title">Manage Chapter</h3>
            </div>
            <div class="box-body">
            <div class="text-center">
                  <!-- Title -->
                  <h4> <?php echo e($chapter->chapter_name); ?></h4>
                    <!-- select -->
                  <?php if($chapter->category == 0): ?>
                  <h5>Chapter Category : Material</h5>
                  <p><?php echo html_entity_decode($chapter['material']->description); ?></p>
                  <?php else: ?>
                  <h5>Chapter Type : Test</h5>
                  <p><?php echo html_entity_decode($chapter['test']->description); ?></p>
                  <?php endif; ?>
            </div>
                  
                  <?php if($chapter->category == 0): ?>
                  <!-- ADD MATERIAL  -->
                  <div class="box box-success text-left col-md-6" id="add_material_form">
                    <div class="box-header">
                      <h3 class="box-title">Add Material Attachments</h3>  
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- MATERIAL UPLOADED -->
                        <div class="box box-success col-md-6">
                          <div class="box-body">
                            <h5><strong>Material Uploaded</strong></h5>
                            <p>
                              <?php if(count($chapter['material']['files_material']) == 0): ?>
                              no material uploaded
                              <?php else: ?>
                              <?php $__currentLoopData = $chapter['material']['files_material']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <a href="" class="btn btn-default" style="width: 90%"><?php echo e($file->attachment_name); ?></a><span class="pull-right"><i class="fa fa-times" style="color: red" aria-hidden="true">remove</i></span>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                            </p>
                          </div>
                          <!-- /.box-body -->
                        </div>

                        <!-- UPLOAD MATERIAL FORM -->
                        <div class="box box-warning col-md-6">

                          <!-- /.box-header -->
                          <div class="box-body">
                            <h5>Form Upload</h5>
                            <!-- Title -->
                            <div class="form-group col-md-6">
                              <label for="title">Attachment Name</label>
                              <input type="text" class="form-control" id="title" name="title" id="title" placeholder="Attachment Name">
                            </div>

                            <!-- File -->
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile">Image Thumbnail</label>
                                <input type="file" id="exampleInputFile" accept=".pdf">
                            </div>
                            <div class="form-group col-md-12 text-center">
                              <input type="submit" name="submit" class="btn btn-info">
                            </div>
                          </div>
                          <!-- /.box-body -->
                        </div>

                    </div>
                    <!-- /.box-body -->
                  </div>

                  <?php else: ?>
                  <!-- ADD TEST QUESTION AND ANSWER -->
                    <div class="box box-warning text-left" id="add_test_form">
                    <div class="box-header">
                      <h3 class="box-title">Test Question</h3> 
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul style="list-style-type: none;">
                        <?php if(count($chapter['test']['questions']) == 0): ?>
                        no question
                        <?php else: ?>
                        <?php $__currentLoopData = $chapter['test']['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($key + 1); ?>. <?php echo e($question->question_text); ?> <span class="pull-right" style="color: red"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit</i> <i class="fa fa-times" aria-hidden="true">remove</i></span>
                          <ul style="list-style-type: none;">
                            <?php $__currentLoopData = $question['option']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($option->is_true == 1): ?>
                            <li><input type="radio" name="<?php echo e($question->id); ?>" checked>
                                <?php echo html_entity_decode($option->option_text); ?>

                                <span style="color: green"><i class="fa fa-check" aria-hidden="true"></i> true answer</span></li>
                            <?php else: ?>
                            <li><input type="radio" name="<?php echo e($question->id); ?>" value="option1">
                                <?php echo html_entity_decode($option->option_text); ?></li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                          </ul>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </ul><br>

                      <!-- FORM ADD QUESTION -->
                      <h5><strong>Add Question</strong></h5>
                      <form action="<?php echo e(url('add_question_submit')); ?>" method="post">
                        <?php echo e(csrf_field()); ?>

                        <input type="hidden" name="id_chapter" value="<?php echo e($chapter->id); ?>">
                        <input type="hidden" name="id_test" value="<?php echo e($chapter['test']->id); ?>">

                      <!-- Question -->
                      <div class="form-group">
                          <label>Question</label>
                          <textarea class="textarea" name="question_text" placeholder="add question here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </div>
                      <!-- Option -->
                      <div class="col-md-6">
                        <div class="form-group">
                          <label for="title">Option 1</label>
                          <input type="text" class="form-control" name="option1" placeholder="Option 1">
                        </div>
                        <div class="form-group">
                          <label for="title">Option 2</label>
                          <input type="text" class="form-control" name="option2"  placeholder="Option 2">
                        </div>
                        <div class="form-group">
                          <label for="title">Option 3</label>
                          <input type="text" class="form-control" name="option3" placeholder="Option 3">
                        </div>
                        <div class="form-group">
                          <label for="title">Option 4</label>
                          <input type="text" class="form-control" name="option4"  placeholder="Option 4">
                        </div>
                        
                      </div>
                      <div class="col-md-6">
                        <!-- select -->
                        <div class="form-group col-md-12">
                          <label>Select True Answer</label>
                          <select class="form-control" id="add_chapter_type">
                            <option value="0">Material</option>
                            <option value="1">Test</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12 text-center">
                       <input type="submit" name="submit" class="btn btn-default">
                      </div>
                      </form>
                      <?php endif; ?>


                    </div>
                    <!-- /.box-body -->
                  </div>


                  <div class="row text-center">
                    <button class="btn btn-success">Save Chapter</button>
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

<script src="<?php echo e(URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
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