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
            <div class="box-header">

                <div class="pull-right">
                <a
                    data-toggle="modal" data-target="#myModal"
                    class="btn btn-danger" style="word-spacing: normal;"
                >
                    <i style="" class="fa fa-remove" aria-hidden="true"></i>

                    Delete This Thread Forum
                </a>


                <script>
                    function submit_modal(){
                        window.open('{{url(action('ForumController@forum_remove',$forum->id))}}','_self')
                        //$('#form_delete').submit();
                    }
                </script>
                <!-- Modal Delete Chapter -->
                <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h1 class="modal-title text-center" id="myModalLabel"><strong>Are you serious to delete this thread forum?</strong></h1>
                            </div>
                            <div class="modal-body text-center">
                                <p>The deleted thread cannot be restored.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                <button type="button" id="submit_button" onclick="submit_modal()" class="btn btn-danger">Yes</button>
                            </div>
                        </div>
                    </div>
                </div>

                </div>
            </div>
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