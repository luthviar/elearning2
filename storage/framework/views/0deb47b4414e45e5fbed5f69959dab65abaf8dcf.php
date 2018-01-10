<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Participant 
        <small>Training Add Participant</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <form action="<?php echo e(url('training/add_participant')); ?>" method="post">

          <?php echo e(csrf_field()); ?>

          <input type="hidden" name="id_training" value="<?php echo e($training->id); ?>">
            <div class="box-header">
              <h3 class="box-title">Training <?php echo e($training->modul_name); ?> . Add Participant</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Add</th>
                </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $user; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $personnel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><a href="<?php echo e(url('admin/personnel/view-'.$personnel->id)); ?>"><?php echo e($personnel->name); ?></a></td>
                    <td><input type="checkbox" name="user[]" value="<?php echo e($personnel->id); ?>"></td>
                  </tr>                  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
              <div class="text-right">
                <input type="submit" name="submit" class="btn btn-success">
              </div>
            </div>
            <!-- /.box-body -->

          </form>
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
  $('#example2').DataTable({
            autoWidth: true,
            "processing": true,
            "serverSide": false,
            "deferRender": true,
            order: [[ 1, "asc" ]]
        });
  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>