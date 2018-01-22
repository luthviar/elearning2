@extends('admin.layouts.app')

@section('page-name')
Forum Public
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
                @if(Session::get('success') != null)
                    <hr/>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>

                        {{ Session::get('success') }}
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
                </tr>
                </thead>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
    </section>
    <!-- /.content -->

    <!-- Modal Delete Chapter -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h1 class="modal-title text-center" id="myModalLabel">
                        <strong>Are you serious to delete this slider?</strong>
                    </h1>
                </div>
                <div class="modal-body text-center">
                    <p>The deleted slider cannot be restored.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                    <button type="button" id="submit_button" onclick="submit_modal()" class="btn btn-danger">Yes</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

<script type="text/javascript">
    $(document).ready(function () {
        $('#example2').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [3,'desc'],
            "ajax":{
                     "url": "{{ url(action('ForumController@forum_public_list_serverside')) }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "title" },
                { "data": "created_by" },
                { "data": "snippet" },
                { "data": "created_at" }
            ]  

        });
    });
</script>

<script>
    function submit_modal(){
        var a = document.getElementById("myText"+e).value;
{{--        window.open('{{url(action('SliderController@delete_slider',a))}}','_self');--}}

        //$('#form_delete').submit();
    }

    function show_modal(e){
        var a = document.getElementById("myText"+e).value;
{{--        window.open('{{url(action('SliderController@delete_slider',a))}}','_self');--}}

        //$('#form_delete').submit();
    }
</script>


@endsection