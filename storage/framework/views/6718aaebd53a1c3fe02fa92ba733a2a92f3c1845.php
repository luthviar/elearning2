<?php $__env->startSection('content'); ?>

<div class="container"
     style="padding-top: 100px;
     padding-bottom: 100px;">
  <div class="row">
    <div class="text-center" style="border-bottom: 1px solid green;">
      <h3 class="green_color"><?php echo e($chapter->chapter_name); ?></h3>
    </div>
    <div style="padding-top: 5px;">
      <!-- TEST TIME -->
      <div class="col-xs-12 col-md-3">
        <div class="panel panel-default">
          <div class="panel-heading"><strong>Time Remaining</strong></div>
          <div class="panel-body text-center">
            <h3><strong class="green_color">20 minutes</strong></h3>
          </div>
        </div>
      </div>
      <!-- TEST Question -->
      <div class="col-xs-12 col-md-9">
        <h4><strong class="green_color">Answer all question below.</strong></h4>
        <input type="hidden" id="total_question" value="<?php echo e(count($test['questions'])); ?>">
        <form  id="test_form" action="<?php echo e(url('/test_submit')); ?>" method="post">

        <input type="hidden" name="id_chapter" value="<?php echo e($chapter->id); ?>">

          <?php echo e(csrf_field()); ?>


          <ul>
            <?php $__currentLoopData = $test['questions']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li style="list-style-type: none;"><?php echo e($key+1); ?>. <?php echo e($question->question_text); ?>

              <ul>
                <?php $__currentLoopData = $question['option']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <li style="list-style-type: none;"><input type="radio" onclick="count_answer(<?php echo e($key); ?>)" name="<?php echo e($question->id); ?>" value="<?php echo e($option['id']); ?>"> <?php echo e($option['option_text']); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </ul>
            </li>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          
          </ul>
          <div class="text-center">
            <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
              SUBMIT
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you serious to submit ?</h4>
      </div>
      <div class="modal-body text-center">
        <h5>Total Question : <?php echo e(count($test['questions'])); ?></h5>
        <h5 id="total_answered"></h5>
        <h5 id="not_answered"></h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="submit_button" onclick="submit_test()" class="btn btn-primary">Submit Test</button>
      </div>
    </div>
  </div>
</div>



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
var answered = new Array();
var total = 0;
var in_answered = false;

function count_answer( name ) {
  var total_question = document.getElementById('total_question').value;
    for (var i = answered.length - 1; i >= 0; i--) {
      if ( answered[i] == name) {
        in_answered = true;
      }
    }
    if (!in_answered) {
      answered.push(name);
      total += 1;
    }
    if (in_answered) {
      in_answered = false;
    }
    var total_answered = document.getElementById('total_answered');
    total_answered.innerHTML= 'Total Answered : '+ total;
    var not_answered = document.getElementById('not_answered');
    not_answered.innerHTML= 'Total Empty Answer : '+ (total_question-total);

  }  
</script>
<script type="text/javascript">
function submit_test(){
  $('#test_form').submit();
}
</script>

<script>
  
    var parent = document.getElementById("div1");
    var child = document.getElementById("p1");
    parent.removeChild(child);

  
  var parent2 = document.getElementById("div2");
  var child2 = document.getElementById("p2");
  parent2.removeChild(child2);
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>