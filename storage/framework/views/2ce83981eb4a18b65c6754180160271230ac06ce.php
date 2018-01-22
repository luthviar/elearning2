<?php $__env->startSection('page-name'); ?>
    <a href="<?php echo e(url(action('NewsController@news_list'))); ?>">
        <i class="fa fa-arrow-left"></i>
    </a>
    View News
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
                    <?php if($news->is_publish == 0): ?>

                          <a href="<?php echo e(url(action('NewsController@publish_news',$news->id))); ?>"
                             class="btn btn-lg btn-success"
                             data-toggle="tooltip"
                             data-placement="top"
                             title="Tampilkan publik ke seluruh user"
                          >
                              <i style="" class="fa fa-bullhorn" aria-hidden="true"></i>
                              PUBLISH
                          </a>
                    <?php else: ?>
                        <a href="<?php echo e(url(action('NewsController@unpublish_news',$news->id))); ?>"
                           class="btn btn-lg btn-info"
                           data-toggle="tooltip"
                           data-placement="top"
                           title="Sembunyikan news ini dari publik"
                        >
                              <i style="" class="fa fa-bullhorn" aria-hidden="true"></i>
                              UN-PUBLISH
                          </a>
                    <?php endif; ?>

                    <a href="<?php echo e(url(action('NewsController@news_edit',$news->id))); ?>"
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
                            window.open('<?php echo e(url(action('NewsController@news_remove',$news->id))); ?>','_self')
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
                              <h1 class="modal-title text-center" id="myModalLabel"><strong>Are you serious to delete this news?</strong></h1>
                            </div>
                            <div class="modal-body text-center">
                                <p>The deleted news cannot be restored.</p>
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
                  <div class="col-xs-12 col-sm-6 col-md-4">
                    <?php if($news->url_image == null): ?>
                    <img src="<?php echo e(URL::asset('Elegantic/images/ALC.png')); ?>" style="width: 100%; height: 150px;">
                    <?php else: ?>
                    <img src="<?php echo e(URL::asset($news->url_image)); ?>" style="width: 100%; height: 150px;">
                    <?php endif; ?>
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-8">
                    <h3><strong><?php echo e($news->title); ?></strong></h3>
                  </div>
                  
                  <p><?php echo html_entity_decode($news->content); ?></p>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                    <?php if(count($news['attachments'])): ?>
                      <?php $__currentLoopData = $news['attachments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <h6 style="text-indent: 20px;">* <a href="<?php echo e(url($attachment->attachment_url)); ?>"><?php echo e($attachment->attachment_name); ?></a></h6>
                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                      no attachment
                    <?php endif; ?>
                  </div>
                </div>
            
          <!-- /.box -->
        </div>
    </div>
    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>