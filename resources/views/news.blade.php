@extends('layout')

@section('content')

<!-- ********************************************** -->
<!--                  POST                          -->
<!-- ********************************************** -->

  <div class="row" style="padding-top: 20px;">
    <div class="container">
      <!-- News Content and Comments-->
      <div class="col-xs-12 col-sm-6 col-md-8" style="padding-bottom: 20px;">
        <!-- CONTENT -->
        <div id="news_content">
          <div class="col-xs-12 col-sm-6 col-md-4">
            <img src="{{ URL::asset('gambar.png')}}" style="width: 100%; height: 150px;">
          </div>
          <div class="col-xs-12 col-sm-6 col-md-8">
            <h3><strong>{{ $news->title }}</strong></h3>
            <h6><strong>Created at {{ $news->created_at }}</strong> . 10x seen by user</h6>  
          </div>
          
          <p>{{ $news->content }}</p>

          <!-- Attachments -->
          <div>
            <h5><strong>Attachments : </strong></h5>
            @if( !$news['attachments'] instanceof Traversable )

              {{ $news['attachments']}}

            @else

              @foreach ( $news['attachments'] as $attachment)
                <h6 style="text-indent: 20px;">* {{ $attachment->attachment_name}}</h6>
              @endforeach

            @endif
          </div>
        </div>

        <!-- COMMENTS -->
        <div id="news_comments">
          <h3><strong class="green_color">Comments</strong></h3>
          <br>
          @if( !$news['comments'] instanceof Traversable )
              {{ $news['comments'] }}
          @else
            @foreach ( $news['comments'] as $comment)
              <div class="media">
                <div class="media-left">
                  <a href="#">
                    <img class="media-object img-circle" src="{{ URL::asset('gambar.png')}}" alt="..." style="width: 100px; border : 1px solid green;">
                  </a>
                </div>
                <div class="media-body">
                  <h4 class="media-heading">{{ $comment->title}}</h4>
                  <h6>Alexander John, at {{ $comment->created_at }} </h6>
                  <p>{{ $comment->content }}</p>
                  <div>
                    <h6><strong>Attachments :</strong></h6>
                    @if( !$comment['attachments'] instanceof Traversable )
                      $comment['attachments']
                    @else
                      @foreach( $comment['attachments'] as $attachment)
                        <h6 style="text-indent: 20px;">* {{ $attachment->attachment_name }}</h6>
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
            @endforeach
          @endif

          
          @guest
          @else
            <div style="padding-top: 20px;">
              <input type="text" class="form-control" value="[Re]: {{ $news->title }}">
              <textarea class="form-control" rows="3"></textarea><br>
              <button class="btn btn-default" type="submit">Button</button>
            </div>
          @endguest
        </div>
      </div>
      
      <!-- List Last News Post -->
      <div class="col-xs-12 col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading"><strong class="green_color">OTHER NEWS</strong></div>
          <div class="panel-body">
            <ul>
              @foreach ( $last_news as $news)
              <li><a href="{{ URL('/get_news', $news->id) }}"> {{ $news->title }}</a></li>
              @endforeach
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection