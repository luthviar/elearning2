@extends('admin.layouts.app')

@section('page-name')
    <a href="{{ url(action('SliderController@slider_list')) }}">
        <i class="fa fa-arrow-left"></i>
    </a>
    View Slider
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
          <div class="box box-primary">
            <div class="box-header">
                <span class="pull-right">

                  @if($count < 5)
                        @if ($slider['flag_active'] == 0)
                            {{--<a href="{{url(action('SliderController@activate',$slider->id))}}" --}}
                            {{--class="btn btn-success" style="width: 100%">Activate</a>--}}

                            <a href="{{url(action('SliderController@activate',$slider->id))}}"
                                   class="btn btn-lg btn-success"
                                   data-toggle="tooltip"
                                   data-placement="top"
                                   title="Tampilkan slide ini ke home page"
                                >
                                <i style="" class="fa fa-bullhorn" aria-hidden="true"></i>
                                ACTIVATE
                            </a>

                        @else
                            <a href="{{url(action('SliderController@nonactivate', $slider->id))}}"
                               class="btn btn-lg btn-info"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="Slide ini akan tidak ditampilkan ke home page"
                            >
                                <i style="" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                DE-ACTIVATE
                            </a>
                        @endif
                    @else
                        @if ($slider['flag_active'] == 0)

                            <a disabled="true"
                               class="btn btn-lg btn-success"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="Tampilkan slide ini ke home page"
                            >
                                <i style="" class="fa fa-bullhorn" aria-hidden="true"></i>
                                ACTIVATE
                            </a>
                        @else
                            <a href="{{url(action('SliderController@nonactivate', $slider->id))}}"
                               class="btn btn-lg btn-info"
                               data-toggle="tooltip"
                               data-placement="top"
                               title="Slide ini akan tidak ditampilkan ke home page"
                            >
                                <i style="" class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                DE-ACTIVATE
                            </a>
                        @endif
                    @endif


                       <a href="{{url(action('SliderController@edit_slider',$slider->id))}}"
                         class="btn btn-warning" style="word-spacing: normal;">

                        <i style="" class="fa fa-pencil-square-o" aria-hidden="true"></i>
                        Edit
                    </a>

                     <a href="{{url(action('SliderController@delete_slider',$slider->id))}}"
                        class="btn btn-danger" style="word-spacing: normal;">

                        <i style="" class="fa fa-remove" aria-hidden="true"></i>
                        Delete
                    </a>

                </span>
            </div>

            <div class="box-body">
                <!-- CONTENT -->


                <div id="news_content">
                  <div class="col-xs-12 col-sm-12 col-md-12">
                    <img src="{{ URL::asset($slider->url_image)}}" style="width: 100%; height: 250px;border: 1px solid green;">
                    <h3><strong>{{$slider->title}}</strong></h3>
                    <p>{{ $slider->second_title }}</p>
                  </div>
                  
                </div>
            
          <!-- /.box -->
        </div>
    </div>
    </section>
    <!-- /.content -->


@endsection

