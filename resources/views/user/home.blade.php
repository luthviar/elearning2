@extends('user.layouts.app')

@section('content')


    <div class="clearfix"></div>
    <div class="page-container" id="wrapper">

        <div class="page-content-wrapper">
            <!-- Slider -->

            <!-- ********************************************** -->
            <!--                  SLIDER                        -->
            <!-- ********************************************** -->
            <div class="promo" >
                <ul class="slider">
                    @foreach ($sliders as $slide)

                        <li style="background: url({{ (url($slide->url_image) or 'Elegantic/images/ALS.jpg') ?
                                                        url($slide->url_image) : 'Elegantic/images/ALS.jpg'  }})
                                no-repeat 100% 100%; width:100% !important;">
                            <div class="slide-holder">
                                <div class="slide-info">
                                    <h1>{{$slide->title}}</h1>
                                    <p>{!! html_entity_decode(str_limit($slide->second_title, $limit = 360, $end = '...')) !!}</p>
                                    <div class="top-left">
                                        <a class="btn btn-ghost"  href="{{url('slider/view-'.$slide->id)}}">Read More</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

            </div>
            <div class="clearfix"></div>
            <!-- NEWS -->
            <div class="page-content" style="background-color: rgb(243, 247, 248);opacity: 1;">

                <div class="blog-page">
                    <div class="row">
                        <div class="col-md-7 col-sm-6 article-block">
                            <p class="border-panel-title-wrap">
                                <!-- <div class="panel-title-wrap"> -->
                                <span class="panel-title-text">News</span>
                                <!-- </div> -->

                            </p>

                            @foreach ($newses as $news)
                                @if($news->is_publish == 1)
                                <div class="row" >
                                    <div class="col-md-4 blog-img blog-tag-data">
                                        @if(empty($news->image))
                                            <a href="{{ url('/news/'.$news->id) }}" >
                                                <img class="img-responsive" src="{{ url('/Elegantic/images/ALS.jpg') }}" alt="" style="width:100%;height:150px;">
                                            </a>
                                        @else
                                            <a href="{{ url('/news/'.$news->id) }}" >
                                                <img class="img-responsive" src="{{$news->image or 'Elegantic/images/ALS.jpg'}}" alt="" style="width:100%;height:150px;">
                                            </a>
                                        @endif
                                        <ul class="list-inline">
                                            <li>
                                                <i class="fa fa-calendar"></i>
                                                <a href="#">
                                                    {{ date('j M Y, H:i:s',strtotime($news->created_at))  }}
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                    <div class="col-md-8 blog-article">
                                        <h3>
                                            <a href="{{ url('/news/'.$news->id) }}" >
                                                {{ str_limit($news->title, $limit = 50, $end = '...') }}
                                            </a>
                                        </h3>
                                        <p>
                                            {{ strip_tags(str_limit($news->content, $limit = 360, $end = '...')) }}
                                        </p>
                                        <a href="{{ url('/news/'.$news->id) }}" class="btn hijau-muda">
                                            Read more <i class="m-icon-swapright m-icon-white"></i>
                                        </a>
                                    </div>
                                </div>
                                <hr/>
                                @endif
                            @endforeach

                            <ul class="pagination pull-right">
                                <a href="{{ url('/news-board') }}" class="btn hijau-muda">
                                    More News <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </ul>
                        </div>
                        <div class="col-md-4 col-sm-6 article-block">
                            @include('user.layouts.schedule')
                        </div>

                        <div class="col-md-4 col-sm-6 article-block">
                            @include('user.layouts.aerofood_links')
                        </div>
                        <!-- end Div links-->
                    </div>


                </div>

            </div>
            <div class="clearfix"></div>
            <!-- Footer -->
        </div>

    </div>


@endsection