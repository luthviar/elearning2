<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Training
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo e(url('/personnel')); ?>">Training</a></li>
        <li class="active"><?php echo e($training->modul_name); ?></li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary text-center">
            <div class="box-header">
              <h3 class="box-title"><?php echo e($training->modul_name); ?> </h3><span class="pull-right"><a href="<?php echo e(url('edit_training',$training->id)); ?>"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit</i></a></span>
            </div>
            <div class="box-body">

            <div>
              <?php if($training->is_publish == 0): ?>
              <a href="<?php echo e(url('training/publish',$training->id)); ?>" class="btn btn-success">publish training</a>
              <?php else: ?>
              <a href="<?php echo e(url('training/unpublish',$training->id)); ?>" class="btn btn-warning">unpublish training</a>
              <?php endif; ?>
              <a href="<?php echo e(url('training/see_participant',$training->id)); ?>" class="btn btn-info">see participant</a>
            </div>
            
              <!-- select -->
                <div class="form-group col-md-4">
                  <label>Training Parent</label>
                  <select class="form-control" disabled="true">
                  <?php $__currentLoopData = $parent; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $par): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if($par->id == $training->id_parent): ?>
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
                  <input type="text" class="form-control pull-right" value="<?php echo e($training->date); ?>" id="datepicker" disabled="true">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- time Picker -->
              <div class="bootstrap-timepicker col-md-4">
                <div class="form-group">
                  <label>Training Start:</label>

                  <div class="input-group">
                    <input type="text" value="<?php echo e($training->time); ?>" class="form-control" disabled="true">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>

              <!-- Textarea -->
              <div class="form-group">
                  <label>Training Overview</label>
                  <p><?php echo e($training->description); ?></p>
              </div>


            </div>
            <!-- /.box-body -->
          </div>

                 <!-- /.col -->
        <div class="col-md-12">
          <div class="nav-tabs-custom">
          <div class="container">
            <h4>Chapter Training</h4>  
          </div>
          
            <ul class="nav nav-tabs">
              <li class="active"><a href="#chapter_list" data-toggle="tab">Chapter List</a></li>
              <?php if(count($training['chapter']) != 0): ?>
              <?php $__currentLoopData = $training['chapter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($chapter->category == 0): ?>
                <li><a href="#material<?php echo e($chapter->id); ?>" data-toggle="tab"><?php echo e($chapter->chapter_name); ?></a></li>
                <?php else: ?>
                <li><a href="#test<?php echo e($chapter->id); ?>" data-toggle="tab"><?php echo e($chapter->chapter_name); ?></a></li>
                <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
              <li><a href="<?php echo e(url('add_chapter',$training->id)); ?>"><i class="fa fa-plus" aria-hidden="true"></i></a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="chapter_list">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Chapter List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                  <table id="record" class="table table-bordered table-striped">
                    <thead>

                    <tr>
                      <th>No</th>
                      <th>Chapter</th>
                      <th>Type</th>
                      <th>Content Count</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(count($training['chapter']) != null): ?>
                    <?php $__currentLoopData = $training['chapter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                      <td><?php echo e($key+1); ?></td>
                      <td><?php echo e($chapter->chapter_name); ?></td>
                      <?php if( $chapter->category ==0): ?>
                      <td>Material</td>
                      <td><?php echo e(count($chapter['material']['files_material'])); ?> Attachments</td>
                      <?php else: ?>
                      <td>Test</td>
                      <td><?php echo e(count($chapter['test']['questions'])); ?> Question</td>
                      <?php endif; ?>
                      
              
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
              </div>

              <?php if(count($training['chapter']) > 0 ): ?>
              <?php $__currentLoopData = $training['chapter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <?php if($chapter->category == 0): ?>
              <div class="tab-pane" id="material<?php echo e($chapter->id); ?>">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo e($chapter->chapter_name); ?></h3><span class="pull-right"> <a href="<?php echo e(url('manage_chapter',$chapter->id)); ?>"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">manage_chapter</i></a> </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                  <h4><?php echo e($chapter->chapter_name); ?></h4>
                  <p><?php echo e($chapter['material']->description); ?></p>
                  <h5><strong>Attachments</strong></h5>
                  <div>
                    <button onclick="window.location.href='/ViewerJS/index.html#../files/situs.pdf'" class="btn btn-block btn-flat"> Attachment 1</button>
                    <button class="btn btn-block btn-flat"> Attachment 1</button>
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
              </div>

              <?php else: ?>
              <div class="tab-pane" id="test<?php echo e($chapter->id); ?>">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title"><?php echo e($chapter->chapter_name); ?></h3><span class="pull-right"> <a href="<?php echo e(url('manage_chapter',$chapter->id)); ?>"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">manage_chapter</i></a> </span>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                  <h4><?php echo e($chapter->chapter_name); ?></h4>
                  <h5>Test Time : <?php echo e($chapter['test']->time); ?>minutes</h5>
                  <p><?php echo e($chapter['test']->description); ?></p>
                  
                    <div class="box box-success text-left">
                    <div class="box-header">
                      <h3 class="box-title">Test Question</h3>                     
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul style="list-style-type: none;">
                        <?php if(count($chapter['test']['questions']) >0): ?>
                        <?php $__currentLoopData = $chapter['test']['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($key+1); ?>. <?php echo e($question->question_text); ?> 
                          <ul style="list-style-type: none;">
                            <?php if(count($question['option']) >0): ?>
                            <?php $__currentLoopData = $question['option']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($option->is_true == 1): ?>
                            <li><input type="radio" name="<?php echo e($option->id); ?>" checked>
                                <?php echo e($option->option_text); ?>

                                <span style="color: green"><i class="fa fa-check" aria-hidden="true"></i> true answer</span></li>
                            <?php else: ?>
                            <li><input type="radio" name="<?php echo e($option->id); ?>" >
                                <?php echo e($option->option_text); ?></li>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                          </ul>
                        </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                      </ul>
                    </div>
                    <!-- /.box-body -->
                  </div>
                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
              </div>
              <?php endif; ?>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>

              <div class="tab-pane" id="add">
              <div class="box">
                <div class="box-header">
                  <h3 class="box-title">Add Chapter</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body text-center">
                  <!-- Title -->
                  <div class="form-group col-md-6">
                    <label for="title">Chapter Name</label>
                    <input type="text" class="form-control" id="title" name="title" id="title" placeholder="Training title">
                  </div>
                    <!-- select -->
                  <div class="form-group col-md-6">
                    <label>Chapter Type</label>
                    <select class="form-control" id="add_chapter_type">
                      <option value="0">Material</option>
                      <option value="1">Test</option>
                    </select>
                  </div>
                    <!-- Textarea -->
                  <div class="form-group">
                      <label>Chapter Description</label>
                      <textarea class="textarea" id="content" name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                    
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
                            <h5>Material Uploaded</h5>
                            <p>
                              <a href="" class="btn btn-default" style="width: 100%">attachment 1</a>
                              <a href="" class="btn btn-default" style="width: 100%">attachment 2</a>
                              <a href="" class="btn btn-default" style="width: 100%">attachment 3</a>
                            </p>
                          </div>
                          <!-- /.box-body -->
                        </div>

                        <!-- UPLOAD MATERIAL FORM -->
                        <div class="box box-warning col-md-6">
                          <!-- /.box-header -->
                          <div class="box-body">
                            <h5>Form Upload</h5>
                          </div>
                          <!-- /.box-body -->
                        </div>

                    </div>
                    <!-- /.box-body -->
                  </div>


                  <!-- ADD TEST QUESTION AND ANSWER -->
                    <div class="box box-success text-left hidden" id="add_test_form">
                    <div class="box-header">
                      <h3 class="box-title">Test Question</h3>  <span class="pull-right"><i style="color: green;" class="fa fa-plus" aria-hidden="true">add question</i></span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul style="list-style-type: none;">
                        <li>1. Siapakah presiden kita ? <span class="pull-right" style="color: red"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit</i> <i class="fa fa-times" aria-hidden="true">remove</i></span>
                          <ul style="list-style-type: none;">
                            <li><input type="radio" name="optionsRadios" value="option1" checked>
                                Option one is this and that&mdash;be sure to include why it's great
                                <span style="color: green"><i class="fa fa-check" aria-hidden="true"></i> true answer</span></li>
                            <li><input type="radio" name="optionsRadios" value="option1">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                            <li><input type="radio" name="optionsRadios" value="option1">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                          </ul>
                        </li>
                        <li>2. Berapa harga cabe sekarang ? <span class="pull-right" style="color: red"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit</i> <i class="fa fa-times" aria-hidden="true">remove</i></span>
                          <ul style="list-style-type: none;">
                            <li><input type="radio" name="optionsRadios2" value="option2" checked>
                                Option one is this and that&mdash;be sure to include why it's great
                                <span style="color: green"><i class="fa fa-check" aria-hidden="true"></i> true answer</span></li>
                            <li><input type="radio" name="optionsRadios2" value="option2">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                            <li><input type="radio" name="optionsRadios2" value="option2">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                          </ul>
                        </li>
                      </ul>
                    </div>
                    <!-- /.box-body -->
                  </div>


                </div>
                <!-- /.box-body -->
              </div>
              <!-- /.box -->
              </div>
            
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
          <!-- /.box -->
        </div>
    </div>
    <div class="row text-center">
      <button class="btn btn-success">Next Step</button>
    </div>


    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>


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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>