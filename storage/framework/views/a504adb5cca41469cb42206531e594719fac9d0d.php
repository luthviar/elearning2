<?php $__env->startSection('page-name'); ?>
Personnel View
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body">
              <div class="text-center">
                <h2><strong>Training Record</strong></h2>
                <div class="col-md-6 text-right">
                  <h4>Name :</h4>
                </div>
                <div class="col-md-6 text-left">
                  <h4><?php echo e($user->name); ?></h4>
                </div>
                <div class="col-md-6 text-right">
                  <h4>Training :</h4>
                </div>
                <div class="col-md-6 text-left">
                  <h4><?php echo e($training->modul_name); ?></h4>
                </div>
                <div class="col-md-6 text-right">
                  <h4>Status :</h4>
                </div>
                <div class="col-md-6 text-left">
                  <h4><?php echo e($status); ?></h4>
                </div>
              </div>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td><strong>Chapter</strong></td>
                    <td><strong>Chapter Type</strong></td>
                    <td><strong>Status</strong></td>
                    <td><strong>Score</strong></td>
                  </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $user_chapter; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($record['chapter']->chapter_name); ?></td>
                    <?php if($record['chapter']->category ==0): ?>
                    <td>Material</td>
                    <?php else: ?>
                    <td>Test</td>
                    <?php endif; ?>
                    
                    <?php if($record->is_finish ==1): ?>
                    <td>Finish</td>
                    <?php else: ?>
                    <td>Not Finish</td>
                    <?php endif; ?>
                    <?php if($record['chapter']->category ==1): ?>
                    <td><?php echo e($record->score); ?></td>
                    <?php else: ?>
                    <td>--</td>
                    <?php endif; ?>
                  </tr>
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>

              
              
            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        </div>
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->



<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script>
  $(function () {
    $("#record").DataTable();
    $('#score').DataTable();
  });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>