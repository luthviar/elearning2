@extends('admin.layouts.app')

@section('page-name')
    <a href="{{ url(action('TrainingController@manage_training',$training->id)) }}">
        <i class="fa fa-arrow-left"></i>
    </a>
    Participant Training
    <small>Daftar semua participant yang bisa mengikuti training ini.</small>
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title"> Participants of Training: {{$training->modul_name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="col-md-8">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Personnel</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($participant as $key => $personnel)
                  <tr>
                    <td>{{$key + 1}}</td>
                    <td><a href="{{url('admin/personnel/view-'.$personnel->id)}}">{{$personnel->name}}</a></td>
                  </tr>                  
                  @endforeach
                </tbody>
              </table>
              </div>
              <div class="col-md-4">
                  <!-- form add participant -->
                  <h3>Add Participant</h3>
                  <form action="{{url('admin/training/add_participant')}}" method="post">

                  {{csrf_field()}}
                  <input type="hidden" name="id_training" value="{{$training->id}}">
                  <!-- select -->
                  <div class="form-group">
                    <label>Select</label>
                    <select name="user" class="form-control select2">
                      
                      @foreach($users as $user)
                      <option value="{{$user->id}}">{{$user->name}}</option>
                      @endforeach
                    
                    </select>
                  </div>

                  <div class="text-right">
                      <input type="submit" name="submit" class="btn btn-success">
                    </div>
                  </form>
                  <!-- /.form -->    
              </div>
            </div>
            <!-- /.box-body -->
            
            

          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->

@endsection

@section('script')
<script type="text/javascript">
  $('#example2').DataTable({
            autoWidth: true,
            "processing": true,
            "serverSide": false,
            "deferRender": true,
            order: [[ 0, "asc" ]]
        });
  $(".select2").select2();
  
</script>
@endsection