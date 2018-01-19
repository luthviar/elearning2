<?php $__env->startSection('page-name'); ?>
    Manage Chapter Training
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-6">
      <div class="box box-primary">

            <div class="box-header">
              <h3 class="box-title" style="color: red;">
                  Select True Answer<br/>
                  <small>You Should choose one of the options for the true answer.</small>
              </h3>
            </div>

            <div class="box-body">
                 <form action="<?php echo e(url(action('TrainingController@select_answer_submit'))); ?>" method="post">
                   <?php echo e(csrf_field()); ?>

                 
                     <h4><strong>Question content :</strong></h4>
                 <p><?php echo html_entity_decode($question->question_text); ?></p>
                <!-- select -->
                <div class="form-group col-md-12">
                  <label>Select True Answer</label>
                  <select class="form-control" name="true_answer">
                  <?php if(count($question['option']) >0): ?>
                  <?php $__currentLoopData = $question['option']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($option->id); ?>"><?php echo e($option->option_text); ?></option>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                  <?php endif; ?>
                  </select>
                </div>

                <div class="col-md-12 text-center">
                 
                    <button type="submit" name="submit" class="btn btn-info">
                        <i class="fa fa-save" aria-hidden="true"></i>
                        Save The Answer
                    </button>
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

<script>
//    //    this script prevent user from close page
//    window.onbeforeunload = function () {
//        return "Apakah Anda yakin?";
//    };

    //      this function is prevent user from back page
    (function (global) {

        if(typeof (global) === "undefined") {
            throw new Error("window is undefined");
        }

        var _hash = "!";
        var noBackPlease = function () {
            global.location.href += "#";

            // making sure we have the fruit available for juice (^__^)
            global.setTimeout(function () {
                global.location.href += "!";
            }, 50);
        };

        global.onhashchange = function () {
            if (global.location.hash !== _hash) {
                global.location.hash = _hash;
            }
        };

        global.onload = function () {
            noBackPlease();

            // disables backspace on page except on input fields and textarea..
            document.body.onkeydown = function (e) {
                var elm = e.target.nodeName.toLowerCase();
                if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                    e.preventDefault();
                }
                // stopping event bubbling up the DOM tree..
                e.stopPropagation();
            };
        }

    })(window);
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>