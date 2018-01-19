@extends('admin.layouts.app')

@section('page-name')
    <a href="{{ url()->previous() }}">
        <i class="fa fa-arrow-left"></i>
    </a>
    View Forum
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
    <div class="row">
        <div class="col-md-12">
      

          <div class="box box-primary">
            
            <div class="box-body">
                <!-- CONTENT -->
                
                <div id="news_content">
                  
                  <h3><strong>{{$forum->title}}</strong></h3>
                  
                  <p>{!! $forum->content !!}</p>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                    @if($forum['attachment'] instanceof Traversable)
                      @foreach($forum['attachment'] as $attachment)
                        <h6 style="text-indent: 20px;">* {{$attachment->name}}</h6>
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

    </section>
    <!-- /.content -->


@endsection