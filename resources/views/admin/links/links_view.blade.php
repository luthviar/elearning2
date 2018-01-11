@extends('admin.layouts.app')

@section('page-name')
    <a href="{{ url(action('AerofoodLinksController@index')) }}">
        <i class="fa fa-arrow-left"></i>
    </a>
    View Link
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">

        <form method="post" action="{{url(action('AerofoodLinksController@update'))}}"
              enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">


                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">
                            {{--fill here--}}
                            </h3>
                            <span class="pull-right">
                            <a href="{{url(action('AerofoodLinksController@edit',$aero_link->id))}}"
                               class="btn btn-warning" style="word-spacing: normal;">

                                <i style="" class="fa fa-pencil-square-o" aria-hidden="true"></i>

                                Edit
                            </a>
                            <a href="{{url(action('AerofoodLinksController@remove',$aero_link->id))}}"
                               class="btn btn-danger" style="word-spacing: normal;">

                            <i style="" class="fa fa-remove" aria-hidden="true"></i>

                                Delete
                            </a>

                            </span>
                        </div>
                        <div class="box-body">
                            {{csrf_field()}}

                            <input type="hidden" name="id_link" value="{{$aero_link->id}}">
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
                                <p>{{$aero_link->name}}</p>
                                {{--<input type="text" class="form-control" id="name" value="{{$aero_link->name}}"--}}
                                       {{--name="name" placeholder="Name of the System" required ="true" disabled>--}}
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
                                <p>{{$aero_link->detail_url}}</p>
                                {{--<input type="text" class="form-control" id="detail_url" value=""--}}
                                       {{--name="detail_url" placeholder="Short Description of URL" required ="true" disabled>--}}
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
                                <p>{{$aero_link->url}}</p>
                                {{--<input type="text" class="form-control" id="url" value="{{$aero_link->url}}"--}}
                                       {{--name="url" placeholder="URL of System" required ="true" disabled>--}}
                            </div>

                            <!-- ICON -->
                            <div class="form-group">
                                <label for="icon">
                                    Icon
                                </label>
                                <p>
                                    <img src="{{ URL::asset($aero_link->icon) }}" width="40%" />
                                </p>
                            </div>

                            <!-- Title -->
                            <div class="form-group">
                                <label for="title">Name of System</label>
                                <p>{{$aero_link->name}}</p>
                                {{--<input type="text" class="form-control" id="title" value="{{$aero_link->name}}"--}}
                                       {{--name="title" placeholder="News title" required ="true" disabled>--}}
                            </div>

                            <div class="row text-center">
                                <div class="col-lg-12">
                                    {{--<button class="btn btn-block btn-info">UPDATE</button>--}}
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


@endsection

@section('script')
    <script src="{{URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
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


@endsection