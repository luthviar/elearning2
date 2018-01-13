@extends('admin.layouts.app')

@section('page-name')
    Slider
    <small>view slider</small>
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
                {{-- fill something here --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Content</th>
                  <th>Created At</th>
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
                     "url": "{{ url(action('SliderController@slider_list_serverside')) }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "title" },
                { "data": "second_title" },
                { "data": "created_at" },
                { "data": "status" }
            ]  

        });
    });
</script>


@endsection