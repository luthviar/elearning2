<?php $__env->startSection('page-name'); ?>
    Forum Job Family
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Created By</th>
                  <th>Snippet</th>
                  <th>Job Family Name</th>
                  <th>Created At</th>
                  <th>Delete</th>
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
                     "url": "<?php echo e(url(action('ForumController@forum_job_family_list_serverside'))); ?>",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                   },
            "columns": [
                { "data": "title" },
                { "data": "created_by" },
                { "data": "snippet" },
                { "data": "job_family" },
                { "data": "created_at" },
                { "data": "delete" }
            ]  

        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>