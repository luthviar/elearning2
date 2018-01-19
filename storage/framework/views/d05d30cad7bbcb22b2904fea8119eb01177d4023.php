<?php $__env->startSection('page-name'); ?>
    <a href="<?php echo e(url(action('AerofoodLinksController@view',$aero_link->id))); ?>">
        <i class="fa fa-arrow-left"></i>
    </a>
    Edit Link
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Main content -->
    <section class="content">

        <form method="post" action="<?php echo e(url(action('AerofoodLinksController@update'))); ?>"
              enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">


                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">Edit Links</h3>
                        </div>
                        <div class="box-body">
                            <?php echo e(csrf_field()); ?>


                            <input type="hidden" name="id_link" value="<?php echo e($aero_link->id); ?>">
                            <!-- name -->
                            <div class="form-group">
                                <label for="name">
                                    Name of System
                                    <i class="fa fa-info-circle"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="contoh: IMS"
                                    ></i>
                                </label>
                                <input type="text" class="form-control" id="name" value="<?php echo e($aero_link->name); ?>"
                                       name="name" placeholder="Name of the System" required ="true">
                            </div>

                            <!-- detail_url -->
                            <div class="form-group">
                                <label for="detail_url">
                                    Short Description of System
                                    <i class="fa fa-info-circle"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Singkat saja, contoh: Inflight Management System"
                                    ></i>
                                </label>
                                <input type="text" class="form-control" id="detail_url" value="<?php echo e($aero_link->detail_url); ?>"
                                       name="detail_url" placeholder="Short Description of URL" required ="true">
                            </div>

                            <!-- URL -->
                            <div class="form-group">
                                <label for="url">
                                    URL of the System
                                    <i class="fa fa-info-circle"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Isi tanpa menulis HTTPS contoh: ims.aerofood.co.id"
                                    ></i>
                                </label>

                                <input type="text" class="form-control" id="url" value="<?php echo e($aero_link->url); ?>"
                                       name="url" placeholder="URL of System" required ="true">
                            </div>

                            <!-- ICON -->
                            <div class="form-group">
                                <label for="status">
                                    Status
                                    <i class="fa fa-info-circle"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Status dari sistem tersebut, seperti: on progress"
                                    ></i>
                                </label>
                                <input type="text" class="form-control" id="status" value="<?php echo e($aero_link->status); ?>"
                                       name="status" placeholder="Status of the System" required ="true">

                            </div>

                            <!-- COLOR -->
                            <div class="form-group">
                                <label>
                                    Color
                                    <i class="fa fa-info-circle"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Pilihan warna ini akan tampil sesuai pada tampilan user"
                                    ></i>
                                </label>
                                <select class="form-control select2" name="color" style="width: 100%;">
                                    <option value="<?php echo e($aero_link->color); ?>"
                                            selected="true"><?php echo e($aero_link->color); ?></option>
                                    <option value="green">green</option>
                                    <option value="purple">purple</option>
                                    <option value="blue">blue</option>
                                    <option value="yellow">yellow</option>
                                    <option value="dark">dark</option>
                                    <option value="red">red</option>
                                </select>

                            </div>


                            <div class="row text-center">
                                <div class="col-lg-12">
                                    <button class="btn btn-block btn-info">UPDATE</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>

        </form>


    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script src="<?php echo e(URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#title').on('input', function(){
                var input = $('#title').val();
                $('#preview_news_title').html(input);

            });
        });
    </script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                callbacks: {
                    onChange: function(contents, $editable) {
                        console.log('onChange:', contents, $editable);
                        $('#preview_news_content').html(contents, $editable);
                    }
                },
                height: 100,

            });
        });
    </script>
    <script type="text/javascript">
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#img_prev').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#img").change(function() {
            readURL(this);
        });
    </script>
    <script type="text/javascript">
        updateList = function() {
            var input = document.getElementById('file');
            var output = document.getElementById('file_list');

            output.innerHTML = '<ul>';
            for (var i = 0; i < input.files.length; ++i) {
                output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
            }
            output.innerHTML += '</ul>';
        }
    </script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>