@extends('layout')

@section('content')

<!-- ********************************************** -->
<!--                  SLIDER                        -->
<!-- ********************************************** -->

  <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @for ( $i = 0 ;  $i < count($sliders) ; $i++ )
            @if ( $i == 0 )
                <li data-target="#carousel-example-generic" data-slide-to="{{$i}}" class="active"></li>
            @else
                <li data-target="#carousel-example-generic" data-slide-to="{{$i}}"></li>
            @endif
        @endfor
    </ol>
    <div class="carousel-inner" role="listbox">
        @for ( $i = 0 ;  $i < count($sliders) ; $i++ )
            @if ( $i == 0 )
                <div class="item active">
                    <img data-src="holder.js/900x500/auto/#777:#555/text:First slide" alt="First slide" >
                    <div class="carousel-caption">
                        <h2>{{ $sliders[$i]->title }}</h2>
                        <p>{{ $sliders[$i]->second_title }}</p>
                    </div>
                </div>
            @else
                <li data-target="#carousel-example-generic" data-slide-to="{{$i}}"></li>
            @endif
        @endfor
    </div>
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>


<!-- ********************************************** -->
<!--                  News                          -->
<!-- ********************************************** -->

    <div class="row">
      <div class="container">
        <div class="content_head">
          <h4> <strong>News</strong></h4>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="container">
        @foreach ( $newses as $news )
            <div class="col-sm-4 news_padding">
              <img src="assets/img/sass-less.png" alt="Sass and Less support" class="img-responsive news_image">
              <a href="{{ URL ('/get_news', $news->id)}}"><h4>{{ $news->title }}</h4></a>
              <h6><strong>Created at {{ $news->created_at }}</strong></h6>
              <p>{{ $news->content }}</p>
            </div>
        @endforeach
      </div>
    </div>

@endsection