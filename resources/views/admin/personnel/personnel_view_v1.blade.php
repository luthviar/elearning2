@extends('admin.layouts.app')

@section('page-name')
    <a href="{{ url(action('UserController@personnel_list')) }}">
        <i class="fa fa-arrow-left"></i>
    </a>
    Personnel View
@endsection

@section('header')
    <style>
        dt{
            width: 48% !important;
        }
        dd{
            margin-left: 50% !important;
        }
    </style>
@endsection
@section('content')

  <!-- Content Header (Page header) -->

    <!-- Main content -->
    <section class="content">
        @if(Session::get('success') != null)
            <div class="row">
                <div class="col-lg-12">
                    <hr/>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>
                        {{ Session::get('success') }}
                    </div>
                </div>
            </div>
        @endif

        @if(Session::get('failed') != null)
            <div class="row">
                <div class="col-lg-12">
                    <hr/>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Gagal!</h4>
                        {{ Session::get('failed') }}
                    </div>
                </div>
            </div>
        @endif
      <div class="row">
        {{--<div class="col-md-6">--}}

          {{--<!-- Profile Image -->--}}
          {{--<div class="box box-solid">--}}
              {{--<div class="box-header with-border">--}}
                  {{--@if($profile['personal_data']->photo == null)--}}
                      {{--<img class="profile-user-img img-responsive img-circle"--}}
                           {{--src="{{URL::asset('photo/user-default.png')}}" alt="User profile picture">--}}
                  {{--@else--}}
                      {{--<img class="profile-user-img img-responsive img-circle"--}}
                           {{--src="{{URL::asset($profile['personal_data']->photo)}}" alt="User profile picture">--}}
                  {{--@endif--}}

                  {{--<h3 class="profile-username text-center">{{$profile['personal_data']->name}}</h3>--}}

                  {{--<p class="text-muted text-center">{{$profile['personal_data']->position_name}}</p>--}}
              {{--</div>--}}

              {{--<div class="box-body">--}}
                  {{--<dl class="dl-horizontal">--}}
                  {{--@if ($profile['personal_data']->role == 1)--}}
                      {{--<dt>--}}
                          {{--<b>Role</b>--}}
                      {{--<dd>--}}
                          {{--<a>Administrator</a>--}}
                      {{--</dd>--}}
                  {{--@else--}}
                      {{--<dt>--}}
                          {{--<b>Role</b>--}}
                      {{--<dd>--}}
                          {{--<a>User</a>--}}
                      {{--</dd>--}}
                  {{--@endif--}}
                      {{--<dt>--}}
                          {{--<b>Email</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >{{$profile['personal_data']->email}}</a>--}}
                      {{--</dd>--}}
                      {{--<dt>--}}
                          {{--<b>Level</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >{{$profile['level']->nama_level}}</a>--}}
                      {{--</dd>--}}
                      {{--<dt>--}}
                          {{--<b>Employee Status</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >{{$profile['employee_data']['employee_status']->name}}</a>--}}
                      {{--</dd>--}}
                      {{--<dt>--}}
                          {{--<b>Birtdate</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >{{$profile['personal_data']->birtdate}}</a>--}}
                      {{--</dd>--}}
                      {{--<dt>--}}
                          {{--<b>Education</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >{{ $profile['personal_data']->education}}</a>--}}
                      {{--</dd>--}}
                      {{--<dt>--}}
                          {{--<b>Date Join</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >{{$profile['personal_data']->date_join_acs}}</a>--}}
                      {{--</dd>--}}
                      {{--<dt>--}}
                          {{--<b>Division</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >{{$profile['employee_data']['division']->division_name or null}}</a>--}}
                      {{--</dd>--}}
                      {{--<dt>--}}
                          {{--<b>Unit</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >{{$profile['employee_data']['unit']->unit_name or null}}</a>--}}
                      {{--</dd>--}}
                      {{--<dt>--}}
                          {{--<b>Department</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >{{$profile['employee_data']['department']->department_name or null}}</a>--}}
                      {{--</dd>--}}
                      {{--<dt>--}}
                          {{--<b>Section</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >{{$profile['employee_data']['section']->section_name or null}}</a>--}}
                      {{--</dd>--}}

                  {{--@if ($profile['personal_data']->flag_active == 1)--}}
                      {{--<dt>--}}
                          {{--<b>Status</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >Active</a>--}}
                      {{--</dd>--}}
                  {{--@else--}}
                      {{--<dt>--}}
                          {{--<b>Status</b>--}}
                      {{--</dt>--}}
                      {{--<dd>--}}
                          {{--<a >Non-Active</a>--}}
                      {{--</dd>--}}
                  {{--@endif--}}

                  {{--</dl>--}}
                  {{--<a href="{{url(action('UserController@edit_personnel',$profile['personal_data']->id))}}"--}}
                     {{--class="btn btn-info btn-block">--}}
                      {{--<b>Edit Personnel</b>--}}
                  {{--</a>--}}
                  {{--@if ($profile['personal_data']->flag_active == 1)--}}

                      {{--<a href="{{url(action('UserController@nonactivate',$profile['personal_data']->id))}}"--}}
                         {{--class="btn btn-danger btn-block">--}}
                          {{--<b>Non-Activate</b>--}}
                      {{--</a>--}}
                  {{--@else--}}

                      {{--<a href="{{url(action('UserController@activate',$profile['personal_data']->id))}}"--}}
                         {{--class="btn btn-success btn-block">--}}
                          {{--<b>Activate</b>--}}
                      {{--</a>--}}
                  {{--@endif--}}

              {{--</div>--}}
            {{--<!-- /.box-body -->--}}
          {{--<!-- /.box -->--}}

          {{--</div>--}}
        {{--</div>--}}


        <!-- /.col -->
        <div class="col-md-10 col-md-offset-1">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#employee" data-toggle="tab">Employee Data</a></li>
              <li><a href="#activity" data-toggle="tab">Training Record</a></li>
              <li><a href="#timeline" data-toggle="tab">Employee Score</a></li>
            </ul>
            <div class="tab-content">
                <div class="active tab-pane" id="employee">
                    <div class="box">
                        <div class="box-header with-border">
                            @if($profile['personal_data']->photo == null)
                                <img class="profile-user-img img-responsive img-circle"
                                     src="{{URL::asset('photo/user-default.png')}}" alt="User profile picture">
                            @else
                                <img class="profile-user-img img-responsive img-circle"
                                     src="{{URL::asset($profile['personal_data']->photo)}}" alt="User profile picture">
                            @endif

                            <h3 class="profile-username text-center">{{$profile['personal_data']->name}}</h3>

                            <p class="text-muted text-center">{{$profile['personal_data']->position_name}}</p>
                        </div>

                        <div class="box-body">
                            <dl class="dl-horizontal">
                                @if ($profile['personal_data']->role == 1)
                                    <dt>
                                        <b>Role</b>
                                    <dd>
                                        <a>Administrator</a>
                                    </dd>
                                @else
                                    <dt>
                                        <b>Role</b>
                                    <dd>
                                        <a>User</a>
                                    </dd>
                                @endif
                                <dt>
                                    <b>Email</b>
                                </dt>
                                <dd>
                                    <a >{{$profile['personal_data']->email}}</a>
                                </dd>
                                <dt>
                                    <b>Level</b>
                                </dt>
                                <dd>
                                    <a >{{$profile['level']->nama_level}}</a>
                                </dd>
                                <dt>
                                    <b>Employee Status</b>
                                </dt>
                                <dd>
                                    <a >{{$profile['employee_data']['employee_status']->name}}</a>
                                </dd>
                                <dt>
                                    <b>Birtdate</b>
                                </dt>
                                <dd>
                                    <a >{{$profile['personal_data']->birtdate}}</a>
                                </dd>
                                <dt>
                                    <b>Education</b>
                                </dt>
                                <dd>
                                    <a >{{ $profile['personal_data']->education}}</a>
                                </dd>
                                <dt>
                                    <b>Date Join</b>
                                </dt>
                                <dd>
                                    <a >{{$profile['personal_data']->date_join_acs}}</a>
                                </dd>
                                <dt>
                                    <b>Division</b>
                                </dt>
                                <dd>
                                    <a >{{$profile['employee_data']['division']->division_name or null}}</a>
                                </dd>
                                <dt>
                                    <b>Unit</b>
                                </dt>
                                <dd>
                                    <a >{{$profile['employee_data']['unit']->unit_name or null}}</a>
                                </dd>
                                <dt>
                                    <b>Department</b>
                                </dt>
                                <dd>
                                    <a >{{$profile['employee_data']['department']->department_name or null}}</a>
                                </dd>
                                <dt>
                                    <b>Section</b>
                                </dt>
                                <dd>
                                    <a >{{$profile['employee_data']['section']->section_name or null}}</a>
                                </dd>

                                @if ($profile['personal_data']->flag_active == 1)
                                    <dt>
                                        <b>Status</b>
                                    </dt>
                                    <dd>
                                        <a >Active</a>
                                    </dd>
                                @else
                                    <dt>
                                        <b>Status</b>
                                    </dt>
                                    <dd>
                                        <a >Non-Active</a>
                                    </dd>
                                @endif

                            </dl>
                            <a href="{{url(action('UserController@edit_personnel',$profile['personal_data']->id))}}"
                               class="btn btn-info btn-block">
                                <b>Edit Personnel</b>
                            </a>
                            @if ($profile['personal_data']->flag_active == 1)

                                <a href="{{url(action('UserController@nonactivate',$profile['personal_data']->id))}}"
                                   class="btn btn-danger btn-block">
                                    <b>Non-Activate</b>
                                </a>
                            @else

                                <a href="{{url(action('UserController@activate',$profile['personal_data']->id))}}"
                                   class="btn btn-success btn-block">
                                    <b>Activate</b>
                                </a>
                            @endif

                        </div>
                    </div>
                    <!-- /.box -->
                </div>
              <div class="tab-pane" id="activity">
		          <div class="box">
		            <div class="box-header">
		              <h3 class="box-title">Training Record Data</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <table id="record" class="table table-bordered table-striped">
		                <thead>

		                <tr>
		                  <th>No</th>
		                  <th>Training</th>
		                  <th>Status</th>
		                  <th>See Records</th>
		                </tr>
		                </thead>
		                <tbody>
		                @foreach ( $training_record['records']  as $key => $record)
		                <tr>
		                	<td>{{ $key+1}}</td>
		                	<td>{{ $record['module']->modul_name}}</td>
		                	<td>{{ $record['status']}}</td>
		                	<td>
                                <span>
                                    <a href="{{ url(action('UserController@see_record',[$profile['personal_data']->id,$record['module']->id])) }}
{{--{{url('admin/personnel/'.$profile['personal_data']->id.'/training/'.$record['module']->id)}}--}}
                                            ">
                                        <i class="fa fa-eye" style="color: blue;" aria-hidden="true"></i>
                                        see record
                                    </a>
                                </span>
                            </td>
		                </tr>
		                @endforeach	
		                </tbody>
		              </table>
		            </div>
		            <!-- /.box-body -->
		          </div>
		          <!-- /.box -->
              </div>
              <!-- /.tab-pane -->
              <div class="tab-pane" id="timeline">
                <div class="box">
		            <div class="box-header">
		              <h3 class="box-title">Employee Score</h3> <span class="pull-right"><a href="#" data-toggle="modal" data-target="#add_score"><i style="color:green;" class="fa fa-plus" aria-hidden="true"></i>Add Score</a></span>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
		              <table id="score" class="table table-bordered table-striped">
		                <thead>
		                <tr>
		                  <th>No</th>
		                  <th>Score file</th>
		                  <th>Date</th>
                            <th>Action</th>
		                </tr>
		                </thead>
		                <tbody>
		                @foreach($employee_record as $key => $record)
		                <tr>
		                	<td>{{$key+1}}</td>
		                	<td>
                                <a
                                    onclick="window.open('{{URL::asset($record->attachment_url)}}',
                                            width='+screen.availWidth+',height='+screen.availHeight')"
                                    style="cursor:pointer;"
                                >
                                    {{$record->attachment_name}}
                                </a>
                            </td>
		                	<td>{{ date('j M Y',strtotime($record->created_at))}}</td>
                            <td>
                                <a
                                    data-toggle="modal" data-target="#myModal{{$record->id}}"
                                    class="btn btn-danger" style="word-spacing: normal;"
                                >
                                    <i style="" class="fa fa-remove" aria-hidden="true"></i>

                                    Delete
                                </a>
                            </td>
		                </tr>
                        <script>
                            function submit_modal{{$record->id}}(){
                                window.open('{{url(action('UserController@delete_score',$record->id))}}','_self')
                                //$('#form_delete').submit();
                            }
                        </script>
                        <!-- Modal Delete Score -->
                        <div class="modal fade" id="myModal{{$record->id}}"
                             tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <h1 class="modal-title text-center" id="myModalLabel">
                                            <strong>Are you serious to delete this Score?</strong>
                                        </h1>
                                    </div>
                                    <div class="modal-body text-center">
                                        <p>The deleted score cannot be restored.</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default"
                                                data-dismiss="modal">
                                            No
                                        </button>
                                        <button type="button" id="submit_button"
                                                onclick="submit_modal{{$record->id}}()"
                                                class="btn btn-danger">
                                            Yes
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach



		                </tbody>
		              </table>
		            </div>
		            <!-- /.box-body -->
		          </div>
		          <!-- /.box -->
              </div>
              
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->

<div class="modal fade" id="add_score" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="{{url(action('UserController@add_score'))}}" method="post" enctype="multipart/form-data">


      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add <strong>{{$profile['personal_data']->name}}</strong> Score</h4>
      </div>
      <div class="modal-body">
      {{csrf_field()}}
          <input type="hidden" name="id_user" value="{{$profile['personal_data']->id}}">
          <!-- Name -->
          <div class="form-group col-md-12">
            <label>Attachment Name:</label>
            <div class="input-group col-md-12">
              <input type="text" style="width: 100%" class="form-control" name="attachment_name"  placeholder="attachment name">
            </div>
          </div>
          <!-- Score -->
          <div class="form-group">
              <label for="exampleInputFile">Score File</label>
              {{--<input type="file" name="score" accept=".pdf">--}}
              <input type="file" name="score" id="my_file_score" value="" accept=".pdf">
              <textarea type="text" id="base64" name="encoded_file_score" cols="50" hidden></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
  </div>
</div>


@endsection

@section('script')
<script>
  $(function () {
    $("#record").DataTable();
    $('#score').DataTable();
  });
</script>

<script>
    document.getElementById('my_file_score').addEventListener('change', function(event){

        var input = document.getElementById("my_file_score");

        var fReader = new FileReader();
        fReader.readAsDataURL(input.files[0]);
        fReader.onloadend = function(event){
            document.getElementById("base64").innerHTML = event.target.result;
            console.log(event.target.result);

        }
    });
</script>

@endsection