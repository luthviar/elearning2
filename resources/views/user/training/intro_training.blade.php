@extends('user.training.layouts.app')

@section('content_training')

  @foreach ( Session::get('training')['chapter'] as $key => $chapter)
      @if ($key < $finish_chapter)
          <div style="padding-bottom: 10px;">
              {{--<h1>ajlj</h1>--}}
              @if ($chapter->category == 0)
                  <a href="{{ url('/material', $chapter->id) }}" class="btn btn-default" style="width: 100%;text-align: left;">{{$chapter->chapter_name}}</a>
              @else
                  <a
                     {{--onclick="window.open('{{ url('/test', $chapter->id) }}','popup','width=1366,height=669');"--}}
                     href="{{ url('/test', $chapter->id) }}"
                     class="btn btn-default"
                     style="width: 100%;text-align: left;">{{$chapter->chapter_name}}</a>
              @endif
          </div>
      @else
          <div style="padding-bottom: 10px;">
              <a class="btn btn-default" style="width: 100%;text-align: left;" disabled="true">{{$chapter->chapter_name}}</a>
          </div>
      @endif
  @endforeach



@endsection

