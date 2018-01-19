<?php $__env->startSection('page-name'); ?>
    Add New Link
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">
        <form method="post" action="<?php echo e(url(action('AerofoodLinksController@create'))); ?>"
              enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">


                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">
                                
                            </h3>
                        </div>
                        <div class="box-body">
                            <?php echo e(csrf_field()); ?>


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
                                <input type="text" class="form-control" id="name"
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
                                <input type="text" class="form-control" id="detail_url"
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

                                <input type="text" class="form-control" id="url"
                                       name="url" placeholder="URL of System" required ="true">
                            </div>

                            <!-- STATUS PROGRES -->
                            <div class="form-group">
                                <label for="status">
                                    Status
                                    <i class="fa fa-info-circle"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Status progres dari sistem tersebut. misalkan: on-going"
                                    ></i>
                                </label>
                                <input type="text" class="form-control" id="status"
                                       name="status" placeholder="Status of the system" required ="true">

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
                                    <button class="btn btn-block btn-success">SUBMIT NEW LINK</button>
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
    <script>

        // $(function () {

        //   //bootstrap WYSIHTML5 - text editor
        // var editor =  $(".textarea").wysihtml5({
        //     toolbar: {
        //       "font-styles": true, // Font styling, e.g. h1, h2, etc.
        //       "emphasis": true, // Italics, bold, etc.
        //       "lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
        //       "html": false, // Button which allows you to edit the generated HTML.
        //       "link": true, // Button to insert a link.
        //       "image": false, // Button to insert an image.
        //       "color": true, // Button to change color of font
        //       "blockquote": false, // Blockquote

        //     }
        //   });





        // });

    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $('#title').on('input', function(){
                var input = $('#title').val();
                $('#title_preview').html(input);

            });
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function(){
            $('#second_title').on('input', function(){
                var input = $('#second_title').val();
                $('#second_title_preview').html(input);

            });
        });
    </script>

    <script type="text/javascript">
        function readURL(input) {

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#image_preview').attr('src', e.target.result);
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