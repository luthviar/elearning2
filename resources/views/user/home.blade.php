@extends('user.layouts.app') @section('content')

<div class="clearfix"></div>

<div class="page-container" id="wrapper">
    <div class="page-content-wrapper" style="background-color:#f1f1f1;">
        <div class="promo">
            <ul class="slider">
                @foreach ($sliders->reverse() as $slide)
                <li style="background: url({{ (url($slide->url_image) or 'Elegantic/images/ALS.jpg') ?
                                                        url($slide->url_image) : 'Elegantic/images/ALS.jpg'  }})
                                no-repeat 100% 100%; width:100% !important;">
                    <div class="slide-holder">
                        <div class="slide-info">
                            <h1>{{$slide->title}}</h1>
                            <p>{!! html_entity_decode(str_limit($slide->second_title, $limit = 360, $end = '...')) !!}</p>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>
        <div class="clearfix"></div>
        <div style="margin:100px 0 100px 0;">
            <main role="main" class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="block-title2" style="background-color:transparent !important; border-bottom:none !important; border-top:none !important; padding-top:0px !important;">
                            <div style="font-size:28px; font-weight:300; text-align:center;">NEWS ABOUT AEROFOOD ACS LEARNING CENTER</div>
                            <div class="title-icon2"><i class="fa fa-newspaper-o fa-2x" style="color:#415FC3; margin-top:10px;;"></i></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="carousel carousel-showfourmoveone slide" id="carou-news">
                            <div class="carousel-inner">
                                <?php $n = 0?> @foreach ($newses as $news) 
                                <div class="item <?php if($n == 0){echo 'active';} $n++;?>">
                                    <div class="col-md-3">
                                        <a href="{{ url('/news/'.$news->id) }}" style="text-decoration:none;">
                                            @if(empty($news->url_image))
                                            <div style="border:1px solid #ccc; height:135px; position:relative; border-radius:5px 5px 0px 0px !important;">
                                            <img src="{{ url('Elegantic/images/ALS.jpg') }}" width="100%"/>
                                            </div>
                                            @else
                                            <div style="border:1px solid #ccc; height:135px; position:relative; border-radius:5px 5px 0px 0px !important;">
                                            <img src="{{ url($news->url_image) }}" width="100%"/>
                                            </div>
                                            @endif
                                            <div style="border-top:1px; border-right:1px; border-bottom:1px; border-left:1px; border-style:solid; border-color:#ccc; background-color:#ffffff; padding:1em 1.5em; position:relative; border-radius:0px 0px 5px 5px !important; height:150px; max-height:150px;">
                                                <div style="height:40px;"><b>{{ str_limit($news->title, $limit = 50, $end = '...') }}</b></div>
                                                <div style="margin:5px 0;"><span style="color:#999 !IMPORTANT; font-size:12px;"><i class="fa fa-clock-o"></i>&nbsp;&nbsp;{{ $news->created_at }}</span></div>
                                                <div style="font-size:13px; color:#666 !IMPORTANT;height:40px;">
                                                    @if($news->content_clean == null)
                                                        {!! strip_tags(str_limit($news->content, $limit = 100, $end = '...')) !!}
                                                    @else
                                                        {!! strip_tags(str_limit($news->content_clean, $limit = 100, $end = '...')) !!}
                                                    @endif
                                                </div>

                                            </div>
                                        </a>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <a class="left carousel-control" href="#carou-news" data-slide="prev"><i class="glyphicon glyphicon-chevron-left"></i></a>
                            <a class="right carousel-control" href="#carou-news" data-slide="next"><i class="glyphicon glyphicon-chevron-right"></i></a>
                            
                        </div>
                    </div>
                    <div class="clearfix"></div><br><br><br>
                    <!--LINK-->
                    <div class="col-md-6 col-xs-12">
                        @include('user.layouts.aerofood_links')
                    </div>
                    <!--TRAINING-->
                    <div class="col-md-6 col-xs-12">
                        @include('user.layouts.schedule')
                    </div>

                </div>
                <br><br><br>
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="block-title2" style="background-color:transparent !important; border-bottom:none !important; border-top:none !important; padding-top:0px !important;">
                            <div style="font-size:28px; font-weight:300; text-align:center;">ABOUT AEROFOOD ACS</div>
                            <div class="title-icon2"><i class="fa fa-newspaper-o fa-2x" style="color:#415FC3; margin-top:10px;;"></i></div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="va-table" style="width:70%; margin:0 auto;">
                            <div class="va-middle"><img src="{{ url('/Elegantic/images/ALS.png') }}" alt="" style="width:200px;" /></div>
                            <div class="va-middle" style="color:#666; padding-left:1.5em;">PT Aerofood Indonesia, is the holding company of Aerowisata Group which is also a holding company of Garuda Indonesia Group. Aerofood is a company that serves the procurement of products and logistics needs in flight with domestic and international sizes.</div>
                        </div>
                    </div>
                </div>
            </main>
            
        </div>
    </div>
</div>
@endsection
