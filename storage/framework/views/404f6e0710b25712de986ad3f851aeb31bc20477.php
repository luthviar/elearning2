<?php $__env->startSection('page-name'); ?>
    <a href="<?php echo e(url(action('TrainingController@manage_training',$training->id))); ?>">
        <i class="fa fa-arrow-left"></i>
    </a>
    Participant Training
    <small>Daftar semua participant yang bisa mengikuti training ini.</small>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Participants of Training: <?php echo e($training->modul_name); ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-8">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Personnel</th>
                </tr>
                </thead>
                <tbody>
                  <?php $__currentLoopData = $participant; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $personnel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <tr>
                    <td><?php echo e($key + 1); ?></td>
                    <td><a href="<?php echo e(url('admin/personnel/view-'.$personnel->id)); ?>"><?php echo e($personnel->name); ?></a></td>
                  </tr>                  
                  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
              </table>
              </div>
              <div class="col-md-4">
                  <!-- form add participant -->
                  <h3>Add Participant</h3>
                  <form action="<?php echo e(url('admin/training/add_participant')); ?>" method="post">

                  <?php echo e(csrf_field()); ?>

                  <input type="hidden" name="id_training" value="<?php echo e($training->id); ?>">
                  <!-- select -->
                  <div class="form-group">
                    <label>Select</label>
                    <select name="user" class="form-control select2">
                      
                      <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                      <option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    
                    </select>
                  </div>

                  <div class="text-right">
                      <input type="submit" name="submit" class="btn btn-success">
                    </div>
                  </form>
                  <!-- /.form -->    
              </div>
            </div>
            <!-- /.box-body -->
            
            

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
            order: [[ 0, "asc" ]]
        });
  $(".select2").select2();
  
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>