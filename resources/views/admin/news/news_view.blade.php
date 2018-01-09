@extends('admin.layouts.app')

@section('page-name')
    View News
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
          <div class="box box-primary">
            <div class="box-header">
              <h4>View News</h4>
                <span class="pull-right">
                    @if($news->is_publish == 0)

                          <a href="{{url(action('NewsController@publish_news',$news->id))}}"
                             class="btn btn-lg btn-success"
                             data-toggle="tooltip"
                             data-placement="top"
                             title="Tampilkan publik ke seluruh user"
                          >
                              <i style="" class="fa fa-bullhorn" aria-hidden="true"></i>
                              PUBLISH
                          </a>

                    @endif

                    <a href="{{url(action('NewsController@news_edit',$news->id))}}"
                       class="btn btn-warning" style="word-spacing: normal;">

                        <i style="" class="fa fa-pencil-square-o" aria-hidden="true"></i>

                        Edit
                    </a>

                    <a href="{{url(action('NewsController@news_remove',$news->id))}}"
                       class="btn btn-danger" style="word-spacing: normal;">

                        <i style="" class="fa fa-remove" aria-hidden="true"></i>

                        Delete
                    </a>

                </span>
            </div>
            <div class="box-body">
                <!-- CONTENT -->
<<<<<<< HEAD:resources/views/admin/news_view.blade.php
                @if($news->is_publish == 0)
                <div class="col-md-12">
                  <a href="{{url('news_publish',$news->id)}}" class="btn btn-success" style="width: 100%">publish news</a>
                </div>
                @else
                <div class="col-md-12">
                  <a href="{{url('news_unpublish',$news->id)}}" class="btn btn-warning" style="width: 100%">unpublish news</a>
                </div>
                @endif
=======

>>>>>>> 40d3f8ac340b4f397a676b8fa1ec0f7d40a3a908:resources/views/admin/news/news_view.blade.php
                <div id="news_content">
                  <div class="col-xs-12 col-sm-6 col-md-4">
                    <img src="{{ URL::asset($news->url_image)}}" style="width: 100%; height: 150px;">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-8">
                    <h3><strong>{{$news->title}}</strong></h3>
                  </div>
                  
                  <p>{!! html_entity_decode($news->content) !!}</p>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                    @if(count($news['attachments']))
                      @foreach ($news['attachments'] as $attachment)
                        <h6 style="text-indent: 20px;">* <a href="{{url($attachment->attachment_url)}}">{{$attachment->attachment_name}}</a></h6>
                      @endforeach
                    @else
                      no attachment
                    @endif
                  </div>
                </div>
            
          <!-- /.box -->
        </div>
    </div>
    </section>
    <!-- /.content -->


@endsection

