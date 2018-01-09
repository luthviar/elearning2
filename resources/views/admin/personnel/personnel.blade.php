@extends('admin.layouts.app')

@section('page-name')
    View Personnel
@endsection

@section('content')

  <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Personnel Data</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Role</th>
                  <th>Position</th>
                  <th>Date Join</th>
                  <th>Status</th>
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
            "ajax":{
                     "url": "{{ URL::action('UserController@personnel_list_serverside') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "name" },
                { "data": "role" },
                { "data": "position" },
                { "data": "date_join" },
                { "data": "flag_active" }
            ]  

        });
    });
</script>


@endsection