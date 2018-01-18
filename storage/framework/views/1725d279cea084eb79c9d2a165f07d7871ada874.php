<?php $__env->startSection('page-name'); ?>
    <a href="<?php echo e(url(action('TrainingController@manage_training',$chapter->id_module))); ?>">
        <i class="fa fa-arrow-left"></i>
    </a>
    Manage Chapter Training
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">
    <div class="row">
        <?php if(Session::get('training') != null): ?>
        <div class="col-md-12">
            <div class="box box-primary text-center">
                <div class="box-header">
                    <h1 class="box-title">
                        Training name:
                        <strong><?php echo e(Session::get('training')->modul_name); ?></strong>
                    </h1>

                </div>
                <div class="box-body">


                    <!-- select -->
                    <div class="form-group col-md-4">
                        <label>Training Parent</label>
                        <select class="form-control" disabled="true">
                            <?php $__currentLoopData = Session::get('parent'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $par): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php if($par->id == Session::get('training')->id_parent): ?>
                                    <option selected="true" value="<?php echo e($par->id); ?>"><?php echo e($par->modul_name); ?></option>
                                <?php else: ?>
                                    <option><?php echo e($par->modul_name); ?></option>
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
                            <input type="text" class="form-control pull-right" value="<?php echo e(Session::get('training')->date); ?>" id="datepicker" disabled="true">
                        </div>
                        <!-- /.input group -->
                    </div>
                    <!-- /.form group -->

                    <!-- time Picker -->
                    <div class="bootstrap-timepicker col-md-4">
                        <div class="form-group">
                            <label>Training Start:</label>

                            <div class="input-group">
                                <input type="text" value="<?php echo e(Session::get('training')->time); ?>" class="form-control" disabled="true">

                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                    </div>

                    <div class="col-md-12">
                        <h5><strong>Trainer </strong></h5>
                        <ul style="list-style-type: none;">
                            <?php $__currentLoopData = Session::get('trainer'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $trains): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($key+1); ?>. <strong><?php echo e($trains->trainer_name); ?></strong> - <?php echo e($trains->trainer_info); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>

                </div>
                <!-- /.box-body -->
            </div>
        </div>
        <?php endif; ?>
      <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
            <?php if(Session::get('failed') != null): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <hr/>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Gagal!</h4>
                            <?php echo e(Session::get('failed')); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <?php if(Session::get('success') != null): ?>
                <div class="row">
                    <div class="col-lg-12">
                        <hr/>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                            <?php echo e(Session::get('success')); ?>

                        </div>
                    </div>
                </div>
            <?php endif; ?>
              <h3 class="box-title">
                  
              </h3>
                <span class="pull-right">

                    <a href="<?php echo e(url(action('TrainingController@edit_chapter',$chapter->id))); ?>"
                       class="btn btn-warning" style="word-spacing: normal;">

                        <i style="" class="fa fa-pencil-square-o" aria-hidden="true"></i>

                        Edit Chapter
                    </a>

                    <a
                        data-toggle="modal" data-target="#myModal"
                        
                        class="btn btn-danger" style="word-spacing: normal;">

                        <i style="" class="fa fa-remove" aria-hidden="true"></i>

                        Delete Chapter
                    </a>

                    <script>
                        function submit_modal(){
                            window.open('<?php echo e(url(action('TrainingController@remove_chapter',$chapter->id))); ?>','_self')
                            //$('#form_delete').submit();
                        }
                    </script>
                    <!-- Modal Delete Chapter -->
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h1 class="modal-title text-center" id="myModalLabel"><strong>Are you serious to delete this chapter ?</strong></h1>
                            </div>
                            <div class="modal-body text-center">
                                <p>The deleted chapter cannot be restored.</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                              <button type="button" id="submit_button" onclick="submit_modal()" class="btn btn-danger">Yes</button>
                            </div>
                          </div>
                        </div>
                      </div>

                </span>
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
                  <h5>Test Time : <?php echo e($chapter['test']->time); ?> minutes</h5>
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
                            <h5>
                                <strong>Material Uploaded</strong>
                                <i class="fa fa-question-circle"
                                   style="color: darkseagreen"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Kumpulan file materi yang telah di upload"
                                   aria-hidden="true"></i>
                            </h5>
                            <p>
                              <?php if(count($chapter['material']['files_material']) == 0): ?>
                              no file material uploaded
                              <?php else: ?>
                              <?php $__currentLoopData = $chapter['material']['files_material']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $file): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              
                                 
                                  
                              
                                <a
                                    class="btn btn-default"
                                    onclick="window.open('<?php echo e(URL::asset($file->url)); ?>',width='+screen.availWidth+',
                                            height='+screen.availHeight')"
                                    style="cursor:pointer; text-decoration: none; width: 90%;"
                                >
                                    <?php echo e($file->name); ?> <br/>
                                    
                                </a>
                                <span class="pull-right">
                                    <a href="<?php echo e(url(action('TrainingController@remove_material_file', $file->id))); ?>">
                                      <i class="fa fa-times" style="color: red" aria-hidden="true">remove</i>
                                    </a>
                                </span>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endif; ?>
                            </p>
                          </div>
                          <!-- /.box-body -->
                        </div>

                        <!-- UPLOAD MATERIAL FORM -->
                        <div class="box box-info col-md-6">

                          <!-- /.box-header -->
                          <div class="box-body">
                          <form method="post" action="<?php echo e(url(action('TrainingController@material_add'))); ?>" enctype="multipart/form-data">
                            <h5>
                                Form Upload File Material
                                <i class="fa fa-question-circle"
                                   style="color: skyblue"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Pilih file materi training wajib pdf"
                                   aria-hidden="true"></i>
                            </h5>
                            <!-- Title -->
                            <input type="hidden" name="id_material" value="<?php echo e($chapter['material']->id); ?>">

                            <?php echo e(csrf_field()); ?>

                            <div class="form-group col-md-6">
                              <label for="title">Attachment Name</label>
                              <input type="text" class="form-control"
                                     name="attachment_name" id="title" placeholder="Attachment Name" required>
                            </div>

                            <!-- File -->
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile">The File</label>
                                

                                <input type="file" name="file" id="my_file" value="" accept=".pdf" required>
                                <textarea type="text" id="base64" name="encoded_file" cols="50" hidden></textarea>

                            </div>
                            <div class="form-group col-md-12 text-center">
                                <button type="submit" name="submit" class="btn btn-info">
                                    <i class="fa fa-save"
                                       aria-hidden="true"></i>
                                    Submit The File
                                </button>
                            </div>
                            </form>
                          </div>
                          <!-- /.box-body -->
                        </div>

                    </div>
                    <!-- /.box-body -->
                      <div class="row text-center">
                          <div class="col-lg-12">
                              <a href="<?php echo e(url(action('TrainingController@manage_training',$chapter->id_module))); ?>"
                                 class="btn btn-block btn-success">
                                  Save This Chapter
                              </a>
                          </div>
                      </div>
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
                            <li><hr/>
                                <?php echo e($key + 1); ?>. <?php echo html_entity_decode($question->question_text); ?>

                                <span class="pull-right">
                                  <a href="<?php echo e(url(action('TrainingController@edit_question',$question->id))); ?>">
                                    <i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true"></i>edit
                                  </a>
                                    <br/>
                                  <a
                                      data-toggle="modal" data-target="#myModalRemoveQuestion"
                                      style="cursor: pointer;"
                                  >
                                    <i class="fa fa-times" style="color: red" aria-hidden="true"></i>remove
                                  </a>
                                </span>
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

                              <script>
                                  function submit_remove_question(){
                                      window.open('<?php echo e(url(action('TrainingController@remove_question',$question->id))); ?>','_self')
                                      //$('#form_delete').submit();
                                  }
                              </script>
                              <!-- Modal Delete Chapter -->
                              <div class="modal fade" id="myModalRemoveQuestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                  <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                  <span aria-hidden="true">&times;</span>
                                              </button>
                                              <h1 class="modal-title text-center" id="myModalLabel"><strong>Are you serious to delete this question ?</strong></h1>
                                          </div>
                                          <div class="modal-body text-center">
                                              <p>The deleted question cannot be restored.</p>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                              <button type="button" id="submit_button" onclick="submit_remove_question()" class="btn btn-danger">Yes</button>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        <?php endif; ?>

                      </ul>
                        <br>

                      <!-- FORM ADD QUESTION -->
                    <div class="box box-info col-lg-6">

                        <!-- /.box-header -->
                        <div class="box-body">
                          <h2><strong>Add Question</strong></h2>
                          <form action="<?php echo e(url(action('TrainingController@add_question_submit'))); ?>" method="post">
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id_chapter" value="<?php echo e($chapter->id); ?>">
                            <input type="hidden" name="id_test" value="<?php echo e($chapter['test']->id); ?>">

                              <!-- Question -->
                              <div class="form-group">
                                  <label>Question Content</label>
                                  <textarea class="textarea" id="summernote"
                                            name="question_text" placeholder="add question here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                              </div>
                              <!-- Option -->
                              <h5>
                                  <strong>Options</strong>
                                  <span><button class="add_field_button btn btn-success">+ Add More Option</button></span>
                              </h5>

                              <div class="input_fields_wrap col-md-12" style="padding-top: 10px;">
                                <div class="col-md-12" style="padding-bottom: 5px;">
                                    <input type="text" class="form-control" style="width: 80%;" placeholder="input option" name="option[]">
                                </div>
                                <div class="col-md-12" style="padding-bottom: 5px;">
                                    <input type="text" class="form-control" style="width: 80%;"  placeholder="input option" name="option[]">
                                </div>
                              </div>

                              <div class="col-md-12 text-center">
                                
                                  <button type="submit" name="submit" class="btn btn-info">
                                      <i class="fa fa-save" aria-hidden="true"></i>
                                      Submit This Question
                                  </button>
                              </div>
                          </form>
                        </div>
                    </div>
                      


                    </div>
                    <!-- /.box-body -->
                        <div class="row text-center">
                            <div class="col-lg-12">
                                <a href="<?php echo e(url(action('TrainingController@manage_training',$chapter->id_module))); ?>"
                                   class="btn btn-block btn-success">
                                    Save This Chapter
                                </a>
                            </div>
                        </div>
                  </div>
                      <?php endif; ?>
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

<script>
    document.getElementById('my_file').addEventListener('change', function(event){

        var input = document.getElementById("my_file");

        var fReader = new FileReader();
        fReader.readAsDataURL(input.files[0]);
        fReader.onloadend = function(event){
            document.getElementById("base64").innerHTML = event.target.result;
            console.log(event.target.result);

        }
    });
</script>

    <?php echo $__env->make('admin.layouts.summernote', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <?php echo $__env->make('layouts.loading', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>