@extends('admin.layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Training Access
        <small>Training Access untuk memberikan akses kepada karyawan terhadap suatu training.</small>
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box">
            <div class="box-header">
              <h3 class="box-title">The List of Training Acceess</h3>
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
                  <th><p>Name</p></th>
                  <th><p>Training</p></th>
                  <th>
                      <p>Status
                          <i class="fa fa-info-circle"
                              data-toggle="tooltip"
                              data-placement="top"
                              title="accepted = karyawan tersebut sudah bisa mengikuti training yang bersangkutan."
                          ></i>
                      </p>
                  </th>
                  <th><p>Recent Access</p></th>
                  <th><p>Action</p></th>
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
                     "url": "{{ url(action('TrainingController@admin_access_training_serverside')) }}",
                     "dataType": "json",
                     "type": "POST",
                     "data":{ _token: "{{csrf_token()}}"}
                   },
            "columns": [
                { "data": "name" },
                { "data": "training" },
                { "data": "status" },
                { "data": "updated_at" },
                { "data": "action" }
            ]  

        });
    });
</script>


@endsection