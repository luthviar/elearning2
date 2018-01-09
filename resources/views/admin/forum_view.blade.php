@extends('admin.layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        View Forum
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/personnel')}}">Forum</a></li>
        @if($forum->category == 0)
        <li><a href="{{url('/admin_forum_public')}}">Forum Public</a></li>
        @elseif ($forum->category == 1)
        <li><a href="{{url('/admin_forum_job_family')}}">Forum Job Family</a></li>
        @else
        <li><a href="{{url('/admin_forum_department')}}">Forum Department</a></li>
        @endif
        <li class="active">{{$forum->title}}</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
      

          <div class="box box-primary">
            
            <div class="box-body">
                <!-- CONTENT -->
                
                <div id="news_content">
                  
                  <h3><strong>{{$forum->title}}</strong></h3>
                  
                  <p>{{$forum->content}}</p>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                    @if($forum['attachment'] instanceof Traversable)
                      @foreach($forum['attachment'] as $attchment)
                        <h6 style="text-indent: 20px;">* {{$attachment->attachment->name}}</h6>
                      @endforeach
                    @else
                      no attachment
                    @endif
                  </div>
                
                </div>
              
            </div>
          </div>
          <!-- /.box -->

        </div>
    </div>
    <div class="row text-center">
      <button class="btn btn-success">submit</button>
    </div>


    </section>
    <!-- /.content -->


@endsection