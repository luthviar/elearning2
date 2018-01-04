@extends('user.layouts.app')

@section('content')

<div class="container" style="padding-top: 100px; padding-bottom: 100px;">
  <div class="row">

      {{--INTRO TRAINING--}}
    <div class="text-center">
      <h1><strong>{{ $training->modul_name}}</strong></h1>
      <h5>Contain {{count($training['chapter'])}} chapter . 1271 user finish this course</h5>
      <p>{{ $training['description']}}</p>
    </div>


    {{--<h5><strong>Chapters</strong></h5>--}}
        <div class="col-lg-12" style="border-top: 1px solid #13B795;">
          <div class="tabs tabs-style-underline">
              <nav>
                  <ul>
                      <li class="tab-current">
                          <a href="#" class="icon">
                              <span>
                                  <i class="glyphicon glyphicon-th-list"></i>
                                   List of Chapters
                              </span>
                          </a>
                      </li>
                      @foreach ( $training['chapter'] as $key => $chapter)
                          @if ($key < $finish_chapter)

                                  @if ($chapter->category == 0)
                                      <li class="">
                                          <a href="{{ url('/material', $chapter->id) }}" class="icon">

                                              <span>
                                                  <i class="glyphicon glyphicon-book"></i>
                                                   {{$chapter->chapter_name}}
                                              </span>
                                          </a>
                                      </li>

                                  @else
                                      <li>
                                          <a href="{{ url('/test', $chapter->id) }}"
                                             class="icon"
                                             style="margin-right: 0px;"
                                          >
                                              <span>
                                                  <i class="glyphicon glyphicon-pencil"></i>
                                                   {{$chapter->chapter_name}}
                                              </span>
                                          </a>
                                      </li>

                                  @endif

                          @else
                              <li>
                                  <a href="#" class="icon">
                                      <span>
                                          <i class="glyphicon glyphicon-pencil"></i>
                                          {{$chapter->chapter_name}}
                                      </span>
                                  </a>
                              </li>

                          @endif
                      @endforeach
                  </ul>
              </nav>
              <div class="content-wrap">
                  @foreach ( $training['chapter'] as $key => $chapter)
                      @if ($key < $finish_chapter)
                          <div style="padding-bottom: 10px;">
                              @if ($chapter->category == 0)
                                  <a href="{{ url('/material', $chapter->id) }}" class="btn btn-default" style="width: 100%;text-align: left;">{{$chapter->chapter_name}}</a>
                              @else
                                  <a href="{{ url('/test', $chapter->id) }}"
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

              </div><!-- /content -->
          </div><!-- /tabs -->
      </div>


    
    
    <div class="text-center">
      <a href="#" class="btn btn-success">Finish Training</a>
    </div>
  </div>
</div>

@endsection

