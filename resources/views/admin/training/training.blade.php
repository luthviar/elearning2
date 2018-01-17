@extends('admin.layouts.app')

@section('page-name')
All Training
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">
                  {{-- Fill in here --}}
              </h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Modul Name</th>
                  <th>Parent</th>
                  <th>Snippet</th>
                  <th>Date</th>
                  <th>Time</th>
                  <th>Status</th>
                  <th>Created At</th>
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
            "order": [6, 'desc'],
            "ajax":{
                     "url": "{{ url(action('TrainingController@admin_training_serverside')) }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "modul_name" },
                { "data": "parent" },
                { "data": "snippet" },
                { "data": "date" },
                { "data": "time" },
                { "data": "is_publish" },
                { "data": "created_at" }
            ]  

        });
    });
</script>


@endsection