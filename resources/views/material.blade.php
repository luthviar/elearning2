@extends('layout')

@section('content')

<div class="row" style="padding-top: 20px">
  <div class="container">
    <div class="text-center">
      <h3>{{ $chapter->chapter_name }}</h3>
      <p>{{ $chapter['material']->description    }}</p>
      <h4>Attachments :</h4>
      @foreach ($chapter['material']['files_material'] as $file)
      <div style="padding-bottom: 10px;"><a href="/test" class="btn btn-default" style="width: 100%;">{{ $file->name}}</a></div>
      @endforeach
      <a href="{{ url('/finish_chapter', $chapter->id) }}" class="btn btn-success">Finish this chapter</a>
    </div>
  </div>
</div>

@endsection