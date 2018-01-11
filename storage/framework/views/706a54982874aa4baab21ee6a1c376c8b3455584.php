<?php $__env->startSection('page-name'); ?>
    All Links of Aerofood System
    <i class="fa fa-info-circle"
       data-toggle="tooltip"
       data-placement="top"
       title="Links ini akan ditampilkan di halaman user"
    ></i>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of Links</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Deskripsi</th>
                        <th>URL</th>
                        <th>Icon</th>
                        <th>Color</th>
                    </tr>
                    </thead>

                    <tbody>

                    <?php $__currentLoopData = $links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aero_link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>

                            <td>
                                <a href="<?php echo e(url(action('AerofoodLinksController@view',$aero_link->id))); ?>">
                                    <?php echo e($aero_link->name); ?>

                                </a>
                            </td>
                            <td><?php echo e($aero_link->detail_url); ?> </td>
                            <td><?php echo e($aero_link->url); ?></td>
                            <td><?php echo e($aero_link->icon); ?></td>
                            <td><?php echo e($aero_link->color); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    </tbody>

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
        $(document).ready(function(){
            $('#example2').DataTable();
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>