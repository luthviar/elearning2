@extends('admin.layout_admin')

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
            <div class="box-body">
                <!-- CONTENT -->
                <div id="news_content">
                  <div class="col-xs-12 col-sm-6 col-md-4">
                    <img src="{{ URL::asset('gambar.png')}}" style="width: 100%; height: 150px;">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-8">
                    <h3><strong>{{$news->title}}</strong></h3>
                  </div>
                  
                  <p>{{$news->content}}</p>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                    @if($news['attachment'] instanceof Traversable)
                      @foreach ($news['attachment'] as $attachment)
                        <h6 style="text-indent: 20px;">* {{$attachment->attachment_name}}</h6>
                      @endforeach
                    @else
                      no attachment
                    @endif
                  </div>
                </div>
            
          <!-- /.box -->
        </div>
    </div>
    <div class="row text-center">
      <button class="btn btn-success">Edit This News</button>
    </div>
    </section>
    <!-- /.content -->


@endsection

