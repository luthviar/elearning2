@extends('user.layouts.app')
@section('content')

  <div class="container" style="padding-top: 100px; padding-bottom: 100px;">
    <div class="col-xs-12 col-md-12 text center" style="height: 230px;text-align: center; border-bottom: 1px solid green;">
      @if($profile['personal_data']->photo != null)
      <a style=" height: 58%;" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#change_photo"><img src="{{ URL::asset($profile['personal_data']->photo) }}" alt="..." style="height: 100%; border: 1px solid green;" class="img-circle"></a>
      @else
      <a style=" height: 58%;" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#change_photo"><img src="{{URL::asset('photo/user-default.png') }}" alt="..." style="height: 100%; border: 1px solid green;" class="img-circle"></a>
      @endif
      <h3 class="green_color"><strong>{{$profile['personal_data']->name}}</strong></h3>
      <h4> {{$profile['personal_data']->position_name}} . Aerofood ACS</h4>
    </div>
    <div class="col-xs-12 col-md-12" style="padding-top: 10px;">

      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active" style="width: 25%;"><a href="#home" aria-controls="home" role="tab" data-toggle="tab" class="text-center green_color">Profile</a></li>
        <li role="presentation" style="width: 25%;"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab" class="text-center green_color">Account</a></li>
        <li role="presentation" style="width: 25%;"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab" class="text-center green_color">Training Record</a></li>
        <li role="presentation" style="width: 25%;"><a href="#settings" aria-controls="settings" role="tab" data-toggle="tab" class="text-center green_color">Employee Score</a></li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
          <div class="col-xs-12 col-md-6">
            <h4>Personal Data</h4>
            <table class="table">
              <tbody>
              <tr>
                <td width="50%">Name</td>
                <td>{{ $profile['personal_data']->name}}</td>
              </tr>
              <tr>
                <td width="50%">Email</td>
                <td>{{ $profile['personal_data']->email}}</td>
              </tr>
              <tr>
                <td>Birtdate</td>
                <td>{{ $profile['personal_data']->birtdate}}</td>
              </tr>
              <tr>
                <td width="50%">Gender</td>
                @if($profile['personal_data']->gender == 1)
                <td>Male</td>
                @else
                <td>Female</td>
                @endif
              </tr>
              <tr>
                <td width="50%">Education</td>
                <td>{{ $profile['personal_data']->education}}</td>
              </tr>
              </tbody>
            </table>
          </div>
          <div class="col-xs-12 col-md-6">
            <h4>Employee Data</h4>
            <table class="table">
              <tbody>
              <tr>
                <td width="50%">Employee Status</td>
                <td>{{$profile['employee_data']['employee_status']->name}}</td>
              </tr>
              <tr>
                <td width="50%">Years of working</td>
                <td>{{$profile['personal_data']->years_of_working}} years</td>
              </tr>
              <tr>
                <td width="50%">Division</td>
                <td>{{$profile['employee_data']['division']->division_name or null}}</td>
              </tr>
              <tr>
                <td>Unit</td>
                <td>{{$profile['employee_data']['unit']->unit_name or null}}</td>
              </tr>
              <tr>
                <td width="50%">Department</td>
                <td>{{$profile['employee_data']['department']->department_name or null}}</td>
              </tr>
              <tr>
                <td>Section</td>
                <td>{{$profile['employee_data']['section']->section_name or null}}</td>
              </tr>
              </tbody>
            </table>
          </div>
        </div>

        <div role="tabpanel" class="tab-pane" id="profile">
          <form action="{{url('/change_password')}}" method="post">
            {{ csrf_field() }}
            <div class="col-xs-12 col-md-6 col-md-offset-3">
              <table class="table">
                <tbody>
                <tr>
                  <td width="50%">Username</td>
                  <td>{{ $profile['personal_data']->username }}</td>
                </tr>

                <tr>
                  <td>New Password</td>
                  <td>
                    <input id="change_password" type="password" class="form-control" name="change_password" placeholder="password" required="true" ><span id="change_password_msg"></span></td>
                </tr>
                <tr>
                  <td>Confirm Password</td>
                  <td>
                    <input id="confirm_password" type="password" class="form-control" name="confirm_password" placeholder="confirm password" required="true">
                  </td>
                </tr>
                </tbody>
              </table>
              <button type="submit" class="btn btn-success" style="width: 100%;">Change Password</button>
            </div>
          </form>
        </div>
        <div role="tabpanel" class="tab-pane" id="messages">
          <div class="col-xs-12 col-md-12 text-center">
            <div class="col-xs-12 col-md-6">
              <h4>Training Included</h4>
              <h1 style="font-size: 40px">{{ count($training_record['records']) }}</h1>
            </div>
            <div class="col-xs-12 col-md-6 green_color">
              <h4>Training Finished</h4>
              <h1 style="font-size: 40px">{{ $training_record['total_finish'] }}</h1>
            </div>

            <div class="col-xs-6 col-md-6 col-lg-offset-3 text-center">

              <table class="table table-hover">
                <thead>
                <tr class="text-center">
                  <th scope="col" class="text-center">#</th>
                  <th scope="col" class="text-center">Training Title</th>
                  <th scope="col" class="text-center">Status</th>

                </tr>
                </thead>
                <tbody>
                @if (count($training_record['records']) == 0)
                  <tr>
                    <th scope="row">no training record</th>
                  </tr>
                @else @foreach ( $training_record['records'] as $key=>$record)
                  <tr>
                    <th scope="row">{{ ++$key }}</th>
                    <td><a href="{{ url('/get_training',  $record['module']->id)}}">{{ $record['module']->modul_name}}</a></td>
                    <td>{{ $record['status']}}</td>
                  </tr>
                @endforeach @endif

                </tbody>
              </table>

            </div>
          </div>

        </div>
        <div role="tabpanel" class="tab-pane" id="settings">
          <div class="container text-center">
            @if(isset($score))
            <iframe id="iframe" src="{{URL::to($score->attachment_url)}}"
                    width='100%' height='600' allowfullscreen webkitallowfullscreen>
            @else
              no score
            @endif
            </iframe>
          </div>
        </div>
      </div>

    </div>
  </div>


<!-- MODAL CHANGE PHOTO -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="change_photo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="{{ url('/change_photo') }}" enctype="multipart/form-data">
      {{csrf_field()}}
      <input type="hidden" name="id_user" value="{{$profile['personal_data']->id}}">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change Photo</h4>
      </div>
      <div class="modal-body text-center">
        <div class="text-center">
          @if($profile['personal_data']->photo == null)
          <img id="img_prev" src="{{ URL::asset('photo/user-default.png')}}" style="width: 35%; height: 200px;">
          @else
          <img id="img_prev" src="{{ URL::asset($profile['personal_data']->photo)}}" style="width: 35%; height: 200px;">
          @endif
        </div>
        <!-- Image -->
        <div class="form-group">
            <label for="exampleInputFile">Profile</label>
            <input type="file" id="img" name="image" accept="image/*">
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
<script type="text/javascript">
$(document).ready(function() {
  $('iframe').ready(function() {
     setTimeout(function() {
        $('iframe').contents().find('#download').remove();
     }, 100);
  });
});
</script>
<script type="text/javascript">

  function readURL(input) {


  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      $('#img_prev').attr('src', e.target.result);
    }

    reader.readAsDataURL(input.files[0]);
  }
}

$("#img").change(function() {
  readURL(this);
});
</script>
@endsection