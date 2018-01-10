@extends('admin.layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Participant Training
        <small>Participant Training</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Training {{$training->modul_name}} . Participant</h3>
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
                  <form action="{{url('training/add_participant')}}" method="post">

                  {{csrf_field()}}
                  <input type="hidden" name="id_training" value="{{$training->id}}">
                  <!-- select -->
                  <div class="form-group">
                    <label>Select</label>
                    <select class="form-control select2">
                      <option>option 1</option>
                      <option>option 2</option>
                      <option>option 3</option>
                      <option>option 4</option>
                      <option>option 5</option>
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