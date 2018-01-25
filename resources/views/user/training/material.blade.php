@extends('user.training.layouts.app')

@section('content_training')


<div class="container" style="padding-bottom: 100px;">
  <div class="row">
      <div class="col-lg-10 col-lg-offset-1">
        <div class="text-center">
          <h1>{{ $chapter->chapter_name }}</h1>
          <p>{!! html_entity_decode($chapter['material']->description)     !!}</p>
          <h4>Attachments :</h4>
            @if($chapter['material']['status'] == 'error-file')
                <a
                        class="btn btn-default btn-block btn-lg"
                        style="cursor:pointer; text-decoration: none; color:red;"

                >
                    File Not Found, Please Upload The File.<br/>
                </a>
            @else
          @foreach ($chapter['material']['files_material'] as $file)
          <div style="padding-bottom: 10px;">

              @if($file->url == null)
                  <a
                          class="btn btn-default btn-block btn-lg"
                          style="cursor:pointer; text-decoration: none; color:red;"

                  >
                      {{$file->name}} -- Not Found, Please Upload Again The File.<br/>
                  </a>
                  @else
              <a
                  class="btn btn-default btn-block btn-lg"
                  onclick="window.open('{{URL::asset($file->url)}}',width='+screen.availWidth+',
                          height='+screen.availHeight')"
                  style="cursor:pointer; text-decoration: none;"

              >
                  {{$file->name}} <br/>
              </a>
                  @endif
          </div>
          @endforeach
            @endif

            @if($is_finish->is_finish == 1)
                <a
                        {{--href="{{ url('/finish_chapter', $chapter->id) }}" --}}
                        onclick="window.open('{{ url('/finish_chapter',$chapter->id) }}','_self')"
                        class="btn color-std">
                    Next Chapter
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
              @else
                <a
                        {{--href="{{ url('/finish_chapter', $chapter->id) }}" --}}
                        onclick="window.open('{{ url('/finish_chapter',$chapter->id) }}','_self')"
                        class="btn color-std">
                    Finish this chapter
                    <i class="fa fa-angle-right" aria-hidden="true"></i>
                </a>
            @endif


        </div>
      </div>
  </div>
</div>

@endsection
@if($chapter['material']['status'] == 'error-file')
@else
@section('script')
    <script>
        function openPDF() {
            var myWindow = window.open('', 'MsgWindow', 'width='+screen.availWidth+',height='+screen.availHeight);
            var coba = 'satu';
            myWindow.document.write("<iframe id='iframe' src ='{{ URL::asset($file->url)}}' width='90%' height='90%' allowfullscreen webkitallowfullscreen></iframe>");

            myWindow.document.getElementById('iframe').textContent().removeChild(document.getElementById('download'));
        }
    </script>
@endsection
@endif