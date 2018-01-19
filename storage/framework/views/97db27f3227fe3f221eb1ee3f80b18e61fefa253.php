<?php $__env->startSection('page-name'); ?>
    Slider
    <i class="fa fa-question-circle"
       data-toggle="tooltip"
       data-placement="bottom"
       title="Maksimal jumlah slider yang bisa ditampilkan di halaman utama adalah 5. Jika ingin mengaktifkan slider lain, harus de-active slider yang sedang aktif."
       aria-hidden="true"></i>
    <small>List of all sliders.</small>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
                
                <?php if(Session::get('success') != null): ?>
                    <hr/>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>

                        <?php echo e(Session::get('success')); ?>

                        <?php if(Session::get('success-slider') != null): ?>
                            <a href="<?php echo e(url(action('SliderController@view_slider',
                            Session::get('success-slider')))); ?>"
                               class="btn btn-default btn-sm"
                               style="color: black; text-decoration: none;"
                            >
                                View The Slider
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
                  <th>Title</th>
                  <th>Content</th>
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
            "order":[2,'desc'],
            "ajax":{
                     "url": "<?php echo e(url(action('SliderController@slider_list_serverside'))); ?>",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "<?php echo e(csrf_token()); ?>"}
                   },
            "columns": [
                { "data": "title" },
                { "data": "second_title" },
                { "data": "created_at" },
                { "data": "status" }
            ]  

        });
    });
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>