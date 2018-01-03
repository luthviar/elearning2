@extends('layout')

@section('content')

<div class="row" style="padding-top: 20px;">
  <div class="container">
    <div class="text-center">
      <h4><strong>{{ $training->modul_name}}</strong></h4>
      <h5>Contain {{count($training['chapter'])}} chapter . 1271 user finish this course</h5>
      <p>{{ $training['description']}}</p>
    </div>
    <h5><strong>Chapters .</strong></h5>
    @foreach ( $training['chapter'] as $key => $chapter)
    	@if ($key < $finish_chapter)
    		<div style="padding-bottom: 10px;">
    			@if ($chapter->category == 0)
                	<a href="{{ url('/material', $chapter->id) }}" class="btn btn-default" style="width: 100%;text-align: left;">{{$chapter->chapter_name}}</a>
                @else
                	<a href="{{ url('/test', $chapter->id) }}" class="btn btn-default" style="width: 100%;text-align: left;">{{$chapter->chapter_name}}</a>
                @endif
            </div>
    	@else
    		<div style="padding-bottom: 10px;">
                <a class="btn btn-default" style="width: 100%;text-align: left;" disabled="true">{{$chapter->chapter_name}}</a>
            </div>
    	@endif
    @endforeach
    
    
    <div class="text-center">
      <a href="#" class="btn btn-success">Finish Training</a>
    </div>
  </div>
</div>

@endsection

