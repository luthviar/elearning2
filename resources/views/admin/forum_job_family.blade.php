@extends('admin.layout_admin')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Forum Job Family
        <small>view forum job family</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Forum Job Family</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">Forum Job Family</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Created By</th>
                  <th>Snippet</th>
                  <th>Job Family Name</th>
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
            "ajax":{
                     "url": "{{ url('admin_forum_job_family') }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "title" },
                { "data": "created_by" },
                { "data": "snippet" },
                { "data": "job_family" },
                { "data": "created_at" },
            ]  

        });
    });
</script>


@endsection