@extends('admin.layouts.app')
@section('page-name')
Personnel View
@endsection

@section('content')

  <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-12">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body">
              <div class="text-center">
                <h2><strong>Training Record</strong></h2>
                <div class="col-md-6 text-right">
                  <h4>Name :</h4>
                </div>
                <div class="col-md-6 text-left">
                  <h4>{{$user->name}}</h4>
                </div>
                <div class="col-md-6 text-right">
                  <h4>Training :</h4>
                </div>
                <div class="col-md-6 text-left">
                  <h4>{{$training->modul_name}}</h4>
                </div>
                <div class="col-md-6 text-right">
                  <h4>Status :</h4>
                </div>
                <div class="col-md-6 text-left">
                  <h4>{{$status}}</h4>
                </div>
              </div>

              <table class="table table-bordered">
                <thead>
                  <tr>
                    <td><strong>Chapter</strong></td>
                    <td><strong>Chapter Type</strong></td>
                    <td><strong>Status</strong></td>
                    <td><strong>Score</strong></td>
                  </tr>
                </thead>
                <tbody>
                  @foreach($user_chapter as $record)
                  <tr>
                    <td>{{$record['chapter']->chapter_name}}</td>
                    @if($record['chapter']->category ==0)
                    <td>Material</td>
                    @else
                    <td>Test</td>
                    @endif
                    
                    @if($record->is_finish ==1)
                    <td>Finish</td>
                    @else
                    <td>Not Finish</td>
                    @endif
                    @if($record['chapter']->category ==1)
                    <td>{{$record->score}}</td>
                    @else
                    <td>--</td>
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>

              
              
            
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          
        </div>
        
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->



@endsection

@section('script')
<script>
  $(function () {
    $("#record").DataTable();
    $('#score').DataTable();
  });
</script>

@endsection