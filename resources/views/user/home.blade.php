@extends('user.layouts.app')

@section('content')

    <!-- ********************************************** -->
    <!--                  SLIDER                        -->
    <!-- ********************************************** -->

    <div id="myCarousel" class="carousel slide" data-ride="carousel">

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                @for ( $i = 0 ;  $i < count($sliders) ; $i++ )
                    @if ( $i == 0 )
                        <li data-target="#myCarousel" data-slide-to="{{$i}}" class="active"></li>
                    @else
                        <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                    @endif
                @endfor

            </ol>
            <div class="carousel-inner">
                @for ( $i = 0 ;  $i < count($sliders) ; $i++ )
                    @if ( $i == 0 )
                        <div class="carousel-item active">
                            <img class="first-slide" data-src="holder.js/900x500/auto/#777:#555/text:First slide" width="100%" alt="First slide" >
                            <div class="container">
                                <div class="carousel-caption">
                                    <h2>{{ $sliders[$i]->title }}</h2>
                                    <p>{{ $sliders[$i]->second_title }}</p>
                                </div>
                            </div>
                        </div>
                    @else
                        <li data-target="#myCarousel" data-slide-to="{{$i}}"></li>
                    @endif
                @endfor
                    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- ********************************************** -->
    <!--                  News                          -->
    <!-- ********************************************** -->

    <div class="container">
        <div class="row">
            <div class="container">
                <div class="content_head">
                    <h4> <strong>News</strong></h4>
                </div>
            </div>
        </div>
        @foreach ( $newses as $news )

            <div class="container">


            <div class="row col-lg-8">


                <div class="col">
                    <img src="{{ url('assets/img/sass-less.png') }}" class="img-thumbnail float-left" alt="news image">
                </div>

                <div class="col">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h4 class="card-title">{{ $news->title }}</h4>
                            <p class="card-text">{{ $news->content }}</p>
                            <a href="{{ URL ('/get_news', $news->id)}}" class="btn btn-primary">Read More</a>
                            <p class="card-text">
                                <small class="text-muted">Created at {{ $news->created_at }}</small>
                            </p>
                        </div>
                    </div>
                </div>


            </div>

            </div>

        @endforeach

    </div>
@endsection