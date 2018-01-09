@extends('admin.layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View News
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/admin_news')}}">News</a></li>
        <li class="active">{{$news->title}}</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
          <div class="box box-primary">
            <div class="box-header">
              <h4>View News</h4> <span class="pull-right"><a href="{{url('news_edit',$news->id)}}"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit_this_news</i></a> <a href="{{url('news_remove',$news->id)}}"><i style="color:red;" class="fa fa-remove" aria-hidden="true">delete_this_news</i></a></span>
            </div>
            <div class="box-body">
                <!-- CONTENT -->
                @if($news->is_publish == 0)
                <div class="col-md-12">
                  <a href="{{url('news_publish',$news->id)}}" class="btn btn-success" style="width: 100%">publish news</a>
                </div>
                @else
                <div class="col-md-12">
                  <a href="{{url('news_unpublish',$news->id)}}" class="btn btn-warning" style="width: 100%">unpublish news</a>
                </div>
                @endif
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

