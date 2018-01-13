@extends('admin.layouts.app')

@section('page-name')
    System Access
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <p class="box-title">Ini adalah daftar user yang melakukan request akses lupa password ke sistem E-Learning.</p>

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Email</th>
                    <th>Validation</th>
                    <th>Time</th>
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
                     "url": "{{ url(action('UserController@system_access_serverside')) }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "email" },
                { "data": "is_valid" },
                { "data": "created_at" }
            ]  

        });
    });
</script>


@endsection