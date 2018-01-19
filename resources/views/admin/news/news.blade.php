@extends('admin.layouts.app')

@section('page-name')
    News
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">List of News</h3>
                @if(Session::get('success') != null)
                    <hr/>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>

                        {{ Session::get('success') }}
                        @if(Session::get('success-news') != null)
                        <a href="{{ url(action('NewsController@admin_news_view',Session::get('success-news'))) }}"
                           class="btn btn-default btn-sm"
                           style="color: black; text-decoration: none;"
                        >
                            View The News
                        </a>
                        @endif

                    </div>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Title</th>
                  <th>Created By</th>
                  <th>Snippet</th>
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
            "order": [3, 'desc'],
            "ajax":{
                "url": "{{ URL::action('NewsController@news_list_serverside') }}",
                "dataType": "json",
                "type": "POST",
                "data":{ _token: "{{csrf_token()}}"}
            },
            "columns": [
                { "data": "title" },
                { "data": "created_by" },
                { "data": "snippet" },
                { "data": "created_at" },
                { "data": "is_publish" }
            ]  

        });
    });
</script>


@endsection