@extends('user.layouts.app')

@section('content')

<div style="margin-top:60px; border:none;">
    <img src="{{url('Elegantic/images/head_banner_'.$trainings->id.'.jpg')}}" width="100%" style="border:none; margin:0; padding:0;">
</div>
  <div class="container" style="padding-top: 30px;">
    <div class="row">
      
      <div class='col-md-12'>
        <div class='panel panel-success'>
          <div class='panel-body' style='background-color: #13B795 !important; color: white;'>
            <span class='text-center'>
                <p>{{$trainings->description}}</p>
            </span>
          </div>
        </div>
      </div>

      @if(count($trainings['children']) == 0)
        <div class='col-md-10 col-md-offset-1'>
          <div class='panel panel-default'>
            <div class='panel-body'>
              <span class='pull-left'>
                  <strong>No Training Yet</strong>
              </span>
              <span class='pull-right'>
                  <a href="#" class="btn btn-info">-</a>
              </span>
            </div>
          </div>
        </div>

        <div class="text-center">

        </div>

      @elseif($trainings->id == 3)

        @foreach($job_family as $jobs)

          <div class='col-md-10 col-md-offset-1'>
            <div class='panel panel-warning'>
              <div class='panel-body' style='background-color: lightgreen !important; color: white;'>
					<span class='pull-left'>
						<a id="a-{{$jobs->id}}" onclick="show_training({{$jobs->id}})">
							<strong>Job Family {{$jobs->job_family_name}}</strong>
						</a>
					</span>
              </div>
            </div>
          </div>
          @foreach($trainings['children'] as $children)
            @if($children->id_job_family == $jobs->id)

              <div class='col-md-10 col-md-offset-1 hidden {{$jobs->id}}'>
                <div class='panel panel-default'>
                  <div class='panel-body'>
					<span class='pull-left'>
						<strong>{{$children->modul_name}}</strong>
					</span>
                    <span class='pull-right'>
        @if($children['access']['status'] == 0)

                        <a href="{{url('request_access',$children->id)}}" class="btn btn-danger">Request Access</a>
                      @elseif($children['access']['status'] == 1)

                        <a href="{{url('get_training',$children->id)}}" class="btn btn-info">Access</a>
                      @else

                        <a class="btn btn-warning">Access Requested</a>
                      @endif

					</span>
                  </div>
                </div>
              </div>
            @endif
          @endforeach
        @endforeach

      @else
        @foreach($trainings['children'] as $children)

          <div class='col-md-10 col-md-offset-1'>
            <div class='panel panel-default'>
              <div class='panel-body'>
					<span class='pull-left'>
						<strong>{{$children->modul_name}}</strong>
					</span>
                <span class='pull-right'>
        @if($children['access']['status'] == 0)

                    <a href="{{url('request_access',$children->id)}}" class="btn btn-danger">Request Access</a>
                  @elseif($children['access']['status'] == 1)

                    <a href="{{url('get_training',$children->id)}}" class="btn btn-info">Access</a>
                  @else

                    <a class="btn btn-warning">Access Requested</a>
                  @endif

					</span>
              </div>
            </div>
          </div>
        @endforeach
      @endif



      @endsection

      @section('script')

        <script type="text/javascript">
            function show_training($id_deps){
                $('.'+$id_deps).removeClass('hidden');
                $('#a-'+$id_deps).attr('onclick','hide_training('+$id_deps+')');
            }

            function hide_training($id_deps){
                $('.'+$id_deps).addClass('hidden');
                $('#a-'+$id_deps).attr('onclick','show_training('+$id_deps+')');
            }
        </script>
@endsection