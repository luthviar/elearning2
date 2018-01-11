<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        System Access
        <small>System Access</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">System Acceess</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Email</th>
                  <th>Validation</th>
                  <th>Time</th>
                </tr>
                </thead>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('#example2').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "<?php echo e(url(action('UserController@system_access_serverside'))); ?>",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                   },
            "columns": [
                { "data": "email" },
                { "data": "is_valid" },
                { "data": "created_at" },
            ]  

        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>