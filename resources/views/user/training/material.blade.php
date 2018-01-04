@extends('user.training.layouts.app')

@section('content_training')


<div class="container" style="padding-bottom: 100px;">
  <div class="row">
    <div class="text-center">
      <h1>{{ $chapter->chapter_name }}</h1>
      <p>{{ $chapter['material']->description    }}</p>
      <h4>Attachments :</h4>
      @foreach ($chapter['material']['files_material'] as $file)
      <div style="padding-bottom: 10px;">
        <a href="/file" class="btn btn-default" style="width: 100%;">
          {{ $file->name}}
        </a>
      </div>
      @endforeach
      <a href="{{ url('/test', $chapter->id) }}" class="btn btn-success">Finish this chapter</a>
    </div>
  </div>
</div>

@endsection