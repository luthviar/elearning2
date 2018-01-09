<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary text-center">
            <div class="box-header">
              <h3 class="box-title"><?php echo e($module->modul_name); ?> </h3>
            </div>
            <div class="box-body">
              <table id="record" class="table table-bordered table-striped">
                    <thead>

                    <tr>
                      <th>Participant</th>
                      <?php $__currentLoopData = $module['chapter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <th>Chapter <?php echo e($chapter->chapter_name); ?></th>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $__currentLoopData = $chapter_record; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                          <td><a href="<?php echo e(url('admin/personnel/view-'.$record['user']->id)); ?>"><?php echo e($record['user']->name); ?></a></td>
                          <?php $__currentLoopData = $record['user']['list_chapter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <?php if($chapter->is_finish == 1): ?>
                          <td style="background-color: green;color:white; ">Finish</td>
                          <?php else: ?>
                          <td style="background-color: red;color:white; ">Not Finish</td>
                          <?php endif; ?>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <tr>
                          <td></td>
                          <?php $__currentLoopData = $record['user']['list_chapter']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chapter): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <td ><?php echo e($chapter->score); ?></td>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                  </table>
        

            </div>
            <!-- /.box-body -->
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

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>