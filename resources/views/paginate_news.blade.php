@extends('layout')

@section('content')


<!-- ********************************************** -->
<!--                  News                          -->
<!-- ********************************************** -->

    <div class="row">
      <div class="container">
        <div class="content">
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
    </div>

    <div class="row">
      <div class="container">
        <div style="text-align: center;">
          {{ $newses->links() }}  
        </div>
      </div>
    </div>

@endsection