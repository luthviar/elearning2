<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        News
        <small>view news</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">News</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">News</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Created By</th>
                  <th>Snippet</th>
                  <th>Created At</th>
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
                     "url": "<?php echo e(url('admin_news')); ?>",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                   },
            "columns": [
                { "data": "title" },
                { "data": "created_by" },
                { "data": "snippet" },
                { "data": "created_at" },
                { "data": "is_publish" }
            ]  

        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>