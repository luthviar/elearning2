<?php $__env->startSection('page-name'); ?>
    View All Personnels
    <small>List of All Employees in PT Aerofood Indonesia.</small>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Personnel Data</h3>
                <?php if(empty(Session::get('success')) == false): ?>
                    <hr/>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>

                        <?php echo e(Session::get('success')); ?>

                        <?php if(Session::get('success-personnel') != null): ?>
                            <a href="<?php echo e(url(action('UserController@profile_view',Session::get('success-personnel')))); ?>"
                               class="btn btn-default btn-sm"
                               style="color: black; text-decoration: none;"
                            >
                                View The User
                            </a>
                        <?php endif; ?>

                    </div>
                <?php endif; ?>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Position</th>
                  <th>Date Join</th>
                  <th>Status</th>
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
                     "url": "<?php echo e(URL::action('UserController@personnel_list_serverside')); ?>",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                   },
            "columns": [
                { "data": "name" },
                { "data": "role" },
                { "data": "position" },
                { "data": "date_join" },
                { "data": "flag_active" }
            ]  

        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>