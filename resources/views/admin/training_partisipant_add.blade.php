@extends('admin.layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Participant 
        <small>Training Add Participant</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
        <form action="{{url('training/add_participant')}}" method="post">

          {{csrf_field()}}
          <input type="hidden" name="id_training" value="{{$training->id}}">
            <div class="box-header">
              <h3 class="box-title">Training {{$training->modul_name}} . Add Participant</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Add</th>
                </tr>
                </thead>
                <tbody>
                  @foreach($user as $personnel)
                  <tr>
                    <td><a href="{{url('admin/personnel/view-'.$personnel->id)}}">{{$personnel->name}}</a></td>
                    <td><input type="checkbox" name="user[]" value="{{$personnel->id}}"></td>
                  </tr>                  
                  @endforeach
                </tbody>
              </table>
              <div class="text-right">
                <input type="submit" name="submit" class="btn btn-success">
              </div>
            </div>
            <!-- /.box-body -->

          </form>
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
            order: [[ 1, "asc" ]]
        });
  
</script>
@endsection