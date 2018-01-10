@extends('admin.layouts.app')

@section('page-name')
    <a href="{{ url(action('TrainingController@manage_training',$module->id)) }}">
        <i class="fa fa-arrow-left"></i>
    </a>
    See Participants
@endsection

@section('content')

  <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary text-center">
            <div class="box-header">
                <h1 class="box-title">
                    Training name:
                    <strong>{{$module->modul_name}}</strong>
                </h1>
            </div>
            <div class="box-body">
              <table id="record" class="table table-bordered table-striped">
                    <thead>

                    <tr>
                      <th>Participant</th>
                      @foreach($module['chapter'] as $chapter)
                      <th>Chapter {{$chapter->chapter_name}}</th>
                      @endforeach
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($chapter_record as $record)
                        <tr>
                          <td><a href="{{url('admin/personnel/view-'.$record['user']->id)}}">{{$record['user']->name}}</a></td>
                          @foreach($record['user']['list_chapter'] as $chapter)
                          @if($chapter->is_finish == 1)
                          <td style="background-color: green;color:white; ">Finish</td>
                          @else
                          <td style="background-color: red;color:white; ">Not Finish</td>
                          @endif
                          @endforeach
                        </tr>
                        <tr>
                          <td></td>
                          @foreach($record['user']['list_chapter'] as $chapter)
                          <td >{{$chapter->score}}</td>
                          @endforeach
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
        

            </div>
            <!-- /.box-body -->
          </div>

      
          <!-- /.box -->
        </div>
    </div>
    
    </section>
    <!-- /.content -->


@endsection

@section('script')

@endsection