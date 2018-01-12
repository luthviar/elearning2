<?php $__env->startSection('content'); ?>


  <div class="container" style="padding-top: 100px;">
    <div class="row">
      <div class="text-center">
        <h3><?php echo e($trainings->modul_name); ?></h3>
        <p><?php echo e($trainings->description); ?></p>
      </div>
      <div class='col-md-12'>
        <div class='panel panel-success'>
          <div class='panel-body' style='background-color: #13B795 !important; color: white;'>
            <span class='pull-left'>
                <strong><?php echo e($trainings->modul_name); ?></strong>
            </span>
            <span class='pull-right'>
                <i class='glyphicon glyphicon-chevron-down'></i>
            </span>
          </div>
        </div>
      </div>

      <?php if(count($trainings['children']) == 0): ?>
        <div class='col-md-11 col-md-offset-1'>
          <div class='panel panel-default'>
            <div class='panel-body'>
              <span class='pull-left'>
                  <strong>No Training Yet</strong>
              </span>
              <span class='pull-right'>
                  <a href="#" class="btn btn-info">-</a>
              </span>
            </div>
          </div>
        </div>

        <div class="text-center">

        </div>

      <?php elseif($trainings->id == 3): ?>

        <?php $__currentLoopData = $department; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $deps): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <div class='col-md-11 col-md-offset-1'>
            <div class='panel panel-warning'>
              <div class='panel-body' style='background-color: lightgreen !important; color: white;'>
					<span class='pull-left'>
						<a id="a-<?php echo e($deps->id); ?>" onclick="show_training(<?php echo e($deps->id); ?>)">
							<strong>Department <?php echo e($deps->department_name); ?></strong>
						</a>
					</span>
              </div>
            </div>
          </div>
          <?php $__currentLoopData = $trainings['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($children->id_department == $deps->id): ?>

              <div class='col-md-10 col-md-offset-2 hidden <?php echo e($deps->id); ?>'>
                <div class='panel panel-default'>
                  <div class='panel-body'>
					<span class='pull-left'>
						<strong><?php echo e($children->modul_name); ?></strong>
					</span>
                    <span class='pull-right'>
        <?php if($children['access']['status'] == 0): ?>

                        <a href="<?php echo e(url('request_access',$children->id)); ?>" class="btn btn-danger">Request Access</a>
                      <?php elseif($children['access']['status'] == 1): ?>

                        <a href="<?php echo e(url('get_training',$children->id)); ?>" class="btn btn-info">Access</a>
                      <?php else: ?>

                        <a class="btn btn-warning">Access Requested</a>
                      <?php endif; ?>

					</span>
                  </div>
                </div>
              </div>
            <?php endif; ?>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

      <?php else: ?>
        <?php $__currentLoopData = $trainings['children']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $children): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

          <div class='col-md-11 col-md-offset-1'>
            <div class='panel panel-default'>
              <div class='panel-body'>
					<span class='pull-left'>
						<strong><?php echo e($children->modul_name); ?></strong>
					</span>
                <span class='pull-right'>
        <?php if($children['access']['status'] == 0): ?>

                    <a href="<?php echo e(url('request_access',$children->id)); ?>" class="btn btn-danger">Request Access</a>
                  <?php elseif($children['access']['status'] == 1): ?>

                    <a href="<?php echo e(url('get_training',$children->id)); ?>" class="btn btn-info">Access</a>
                  <?php else: ?>

                    <a class="btn btn-warning">Access Requested</a>
                  <?php endif; ?>

					</span>
              </div>
            </div>
          </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      <?php endif; ?>



      <?php $__env->stopSection(); ?>

      <?php $__env->startSection('script'); ?>

        <script type="text/javascript">
            function show_training($id_deps){
                $('.'+$id_deps).removeClass('hidden');
                $('#a-'+$id_deps).attr('onclick','hide_training('+$id_deps+')');
            }

            function hide_training($id_deps){
                $('.'+$id_deps).addClass('hidden');
                $('#a-'+$id_deps).attr('onclick','show_training('+$id_deps+')');
            }
        </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('user.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>