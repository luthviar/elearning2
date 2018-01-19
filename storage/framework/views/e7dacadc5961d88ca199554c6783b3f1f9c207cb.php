<?php $__env->startSection('page-name'); ?>
    <a href="<?php echo e(url(action('SliderController@slider_list'))); ?>">
        <i class="fa fa-arrow-left"></i>
    </a>
    View Slider
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">
          <div class="box box-primary">
            <div class="box-header">
                <?php if(Session::get('success') != null): ?>
                    <hr/>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                        <?php echo e(Session::get('success')); ?>

                    </div>
                <?php endif; ?>

                <span class="pull-right">

                  <?php if($count < 5): ?>
                        <?php if($slider['flag_active'] == 0): ?>
                            
                            

                            <a href="<?php echo e(url(action('SliderController@activate',$slider->id))); ?>"
                                   class="btn btn-lg btn-success"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Tampilkan slide ini ke home page"
                                >
                                <i style="" class="fa fa-bullhorn" aria-hidden="true"></i>
                                ACTIVATE
                            </a>

                        <?php else: ?>
                            <a href="<?php echo e(url(action('SliderController@nonactivate', $slider->id))); ?>"
                               class="btn btn-lg btn-info"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="Slide ini akan tidak ditampilkan ke home page"
                            >
                                <i style="" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                DE-ACTIVATE
                            </a>
                        <?php endif; ?>
                    <?php else: ?>
                        <?php if($slider['flag_active'] == 0): ?>

                            <a disabled="true"
                               class="btn btn-lg btn-success"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="Tidak bisa ditampilkan karena slider aktif sudah lima, silahkan disable slider yang ada."
                            >
                                <i style="" class="fa fa-bullhorn" aria-hidden="true"></i>
                                ACTIVATE
                            </a>
                        <?php else: ?>
                            <a href="<?php echo e(url(action('SliderController@nonactivate', $slider->id))); ?>"
                               class="btn btn-lg btn-info"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="Slide ini akan tidak ditampilkan ke home page"
                            >
                                <i style="" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                DE-ACTIVATE
                            </a>
                        <?php endif; ?>
                    <?php endif; ?>


                       <a href="<?php echo e(url(action('SliderController@edit_slider',$slider->id))); ?>"
                         class="btn btn-warning" style="word-spacing: normal;">

                        <i style="" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Edit
                    </a>

                     <a
                         data-toggle="modal" data-target="#myModal"
                         class="btn btn-danger" style="word-spacing: normal;"
                     >

                        <i style="" class="fa fa-remove" aria-hidden="true"></i>

                        Delete
                    </a>


                    <script>
                        function submit_modal(){
                            window.open('<?php echo e(url(action('SliderController@delete_slider',$slider->id))); ?>','_self')
                            //$('#form_delete').submit();
                        }
                    </script>

                      <!-- Modal Delete Chapter -->
                      <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                              <h1 class="modal-title text-center" id="myModalLabel">
                                  <strong>Are you serious to delete this slider?</strong>
                              </h1>
                            </div>
                            <div class="modal-body text-center">
                                <p>The deleted slider cannot be restored.</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                              <button type="button" id="submit_button" onclick="submit_modal()" class="btn btn-danger">Yes</button>
                            </div>
                          </div>
                        </div>
                      </div>

                </span>
            </div>

            <div class="box-body">
                <!-- CONTENT -->


                <div id="news_content">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                      <?php if(empty($slider->url_image)): ?>
                          No Image
                      <?php else: ?>
                          <img src="<?php echo e(URL::asset($slider->url_image)); ?>" style="width: 100%; height: 250px;border: 1px solid green;">
                      <?php endif; ?>

                    <h3><strong><?php echo e($slider->title); ?></strong></h3>
                    <p><?php echo e($slider->second_title); ?></p>
                  </div>
                  
                </div>
            
          <!-- /.box -->
        </div>
    </div>
    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>