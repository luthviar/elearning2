@extends('admin.layouts.app')

@section('page-name')
    Add New Link
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <form method="post" action="{{url(action('AerofoodLinksController@create'))}}"
              enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">


                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">
                                {{--FILL HERE--}}
                            </h3>
                        </div>
                        <div class="box-body">
                            {{csrf_field()}}

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

                            <!-- ICON -->
                            <div class="form-group">
                                <label for="icon">
                                    Icon
                                    <i class="fa fa-info-circle"
                                       data-toggle="tooltip"
                                       data-placement="top"
                                       title="Logo dari sistem tersebut"
                                    ></i>
                                </label>

                                <input type="file" name="icon" id="icon"/>

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
                                    <button class="btn btn-block btn-success">SUBMIT</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>

            </div>

        </form>
        {{--<form method="post" action="{{url(action('SliderController@slider_add_submit'))}}" enctype="multipart/form-data">--}}
            {{--<div class="row">--}}
                {{--<div class="col-md-6">--}}


                    {{--<div class="box box-primary">--}}
                        {{--<div class="box-header">--}}
                            {{--<h3 class="box-title">Add Slider</h3>--}}
                        {{--</div>--}}
                        {{--<div class="box-body">--}}
                        {{--{{csrf_field()}}--}}


                        {{--<!-- Title -->--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="title">Title</label>--}}
                                {{--<input type="text" class="form-control" id="title" name="title" placeholder="Slider title">--}}
                            {{--</div>--}}


                            {{--<!-- Image -->--}}
                            {{--<div class="form-group">--}}
                                {{--<label for="exampleInputFile">Image background</label>--}}
                                {{--<input type="file" id="img" name="image">--}}
                            {{--</div>--}}

                            {{--<!-- Textarea -->--}}
                            {{--<div class="form-group">--}}
                                {{--<label>Textarea</label>--}}
                                {{--<textarea class="textarea" id="second_title" name="second_title" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>--}}
                            {{--</div>--}}


                        {{--</div>--}}
                        {{--<!-- /.box-body -->--}}
                    {{--</div>--}}
                    {{--<!-- /.box -->--}}
                {{--</div>--}}
                {{--<div class="col-md-6">--}}


                    {{--<div class="box box-primary">--}}
                        {{--<div class="box-header">--}}
                            {{--<h3 class="box-title">Preview Slider Image</h3>--}}
                        {{--</div>--}}

                        {{--<div class="box-body">--}}
                            {{--<div class="image">--}}
                                {{--<img src="{{url('gambar.png')}}" id="image_preview" width="100%" height="250px">--}}
                            {{--</div>--}}
                            {{--<h4 id="title_preview"></h4>--}}
                            {{--<p id="second_title_preview"></p>--}}

                        {{--</div>--}}
                    {{--</div>--}}
                    {{--<!-- /.box -->--}}

                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="row text-center">--}}
                {{--<button class="btn btn-success">submit</button>--}}
            {{--</div>--}}
        {{--</form>--}}


    </section>
    <!-- /.content -->


@endsection

@section('script')
    <script src="{{URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
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


@endsection