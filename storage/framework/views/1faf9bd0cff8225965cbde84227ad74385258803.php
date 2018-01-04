<?php $__env->startSection('content'); ?>

  <div class="row" style="padding-top: 20px;">
    <div class="container">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="<?php echo e(url('/get_forum/public')); ?>">Public Forum</a>
        </li>
        <li role="presentation">
          <a href="<?php echo e(url('/get_forum/job_family')); ?>">Job Family Forum</a>
        </li>
        <li role="department">
          <a href="<?php echo e(url('/get_forum/department')); ?>">Department Forum</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="public">
          <div class="text-center">
            <h3><strong class="green_color">Public Forum</strong></h3>
            <h5>Forum for All Aerofood employee  </h5>
          </div>
          <table class="table table-striped" id="forum_public">
            <thead>
              <tr>
                <td><strong>Title</strong></td>
                <td><strong>Created by</strong></td>
                <td><strong>Comments</strong></td>
                <td><strong>Last seen</strong></td>
              </tr>
            </thead>
            
          </table>
        </div>
      </div>
    </div>
  </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('#forum_public').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax":{
                     "url": "<?php echo e(url('forum_public')); ?>",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                   },
            "columns": [
                { "data": "title" },
                { "data": "created_by" },
                { "data": "comments" },
                { "data": "last_seen" }
            ]  

        });
    });
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>