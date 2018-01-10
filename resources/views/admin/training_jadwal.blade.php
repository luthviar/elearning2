@extends('admin.layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Jadwal Training 
        <small>Jadwal Training</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Jadwal Training</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Training</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Partisipant</th>
                  <th>Trainer</th>
                  <th>Created_by</th>
                </tr>
                </thead>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->

@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function () {
        $('#example2').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [[1, 'asc']],
            "ajax":{
                     "url": "{{ url('schedule') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "modul_name" },
                { "data": "date" },
                { "data": "time" },
                { "data": "partisipant" },
                { "data": "trainer" },
                { "data": "created_by" }
            ]  

        });
    });
</script>


@endsection