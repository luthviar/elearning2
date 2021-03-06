@extends('admin.layouts.app')

@section('page-name')
    <a href="{{ url(action('TrainingController@manage_training',$module->id)) }}">
        <i class="fa fa-arrow-left"></i>
    </a>
    Edit Training
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">
                {{-- fill in here --}}
              </h3>
            </div>
            <div class="box-body">

            <form action="{{url(action('TrainingController@edit_training_submit'))}}" method="post">
              {{ csrf_field() }}

              <input type="hidden" name="id_module" value="{{$module->id}}">
            
              <!-- Title -->
              <div class="form-group">
                <label for="title">Title*</label>
                <input type="text" class="form-control" id="title" name="modul_name" value="{{$module->modul_name}}" placeholder="Training title">
              </div>


              <!-- select -->
                <div class="form-group col-md-4">
                  <label>Training Parent*</label>
                  <select class="form-control" name="id_parent" id="parent">
                    @foreach($parent as $par)
                    @if ($par->id == $module->id_parent)
                    <option value="{{$par->id}}" selected="true">{{ $par->modul_name}}</option>
                    @else
                    <option value="{{$par->id}}">{{ $par->modul_name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>

             <!-- Date -->
              <div class="form-group col-md-4">
                <label>Training Date Start*</label>

                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" name="date" value="{{$module->date}}" class="form-control pull-right" id="datepicker" dateFormat="yy-mm-dd">
                </div>
                <!-- /.input group -->
              </div>
              <!-- /.form group -->

              <!-- time Picker -->
              <div class="bootstrap-timepicker col-md-4">
                <div class="form-group">
                  <label>Training Time Start*</label>

                  <div class="input-group">
                    <input type="text" name="time" value="{{$module->time}}" class="form-control" placeholder="00:00:00 -- 24 hours format">

                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                  </div>
                  <!-- /.input group -->
                </div>
                <!-- /.form group -->
              </div>

              <!-- select -->
              <div class="col-md-12">
              @if($module->id_parent == 3)
                <div class="form-group col-md-4" id="job_family">
              @else
                <div class="form-group col-md-4 hidden" id="job_family">
              @endif
                  <label>Job Family</label>
                  <select class="form-control" name="id_job_family" >
                    @foreach($job_family as $jobs)
                    @if($jobs->id == $module->id_job_family)
                    <option value="{{$jobs->id}}" selected="true">{{ $jobs->job_family_name}}</option>
                    @else
                    <option value="{{$jobs->id}}">{{ $jobs->job_family_name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                </div>

              <!-- Textarea -->
              <div class="form-group">
                  <label>Training Overview*</label>
                  <textarea class="textarea" id="summernote"
                            name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required>
                      {{$module->description}}
                  </textarea>
              </div>

              <h5>
                  <strong>Trainer</strong>
                  <span><button class="add_field_button btn btn-success">+ Add More Trainer</button></span>
              </h5>

              <div class="input_fields_wrap col-md-12" style="padding-top: 10px;">
              @foreach($trainer as $key => $trains)
              @if($key == 0)
              <div class="col-md-12" style="padding-bottom: 5px;">
                <h6>Trainer Name*</h6>
                <input type="text" class="form-control" style="width: 50%;" value="{{$trains->trainer_name}}" name="trainer_name[]">
                <h6>Trainer Info*
                    <i class="fa fa-question-circle"
                       style="color: darkseagreen"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="Info mengenai trainer tersebut, seperti: berasal dari mana atau apapun."
                       aria-hidden="true"></i>
                </h6>
                <input type="text" class="form-control" style="width: 50%;" value="{{$trains->trainer_info}}" name="trainer_info[]">
                
              </div>
              @else
              <div class="col-md-12" style="padding-bottom: 5px;">
                <h6>Trainer Name</h6>
                <input type="text" class="form-control" style="width: 50%;" value="{{$trains->trainer_name}}" name="trainer_name[]">
                <h6>Trainer Info</h6>
                <input type="text" class="form-control" style="width: 50%;" value="{{$trains->trainer_info}}" name="trainer_info[]"><a href="#" class="remove_field">Remove</a>
                
              </div>
              @endif
              @endforeach
              </div>

              <div class="row text-center">
                  <div class="col-lg-12">
                      <button class="btn btn-block btn-success">Update This Training</button>
                  </div>
              </div>
              </div>

              </form>
            </div>
            <!-- /.box-body -->

          </div>
          <!-- /.box -->

        </div>
    </div>
    


    </section>
    <!-- /.content -->


@endsection

@section('script')
<script type="text/javascript">
  //Date picker
    $('#datepicker').datepicker({
      
      format: 'yyyy-mm-dd',
    });
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false,
      timeFormat: 'HH:i',
    });


</script>

<<!-- script src="{{URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>

  $(function () {
    
    //bootstrap WYSIHTML5 - text editor
  var editor =  $(".textarea").wysihtml5({
      toolbar: {
        "font-styles": true, // Font styling, e.g. h1, h2, etc.
        "emphasis": true, // Italics, bold, etc.
        "lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
        "html": false, // Button which allows you to edit the generated HTML.
        "link": true, // Button to insert a link.
        "image": false, // Button to insert an image.
        "color": true, // Button to change color of font
        "blockquote": false, // Blockquote
        
      }
    });

  
  
  
  
  });

</script> -->

<script type="text/javascript">
$(document).ready(function(){
  $('#title').on('input', function(){ 
    var input = $('#title').val();
    $('#preview_news_title').html(input);

   });
});
</script>
<script type="text/javascript">
$(document).ready(function(){
  $('#content').on('input', function(){ 
    var input = $('#content').val();
    $('#preview_news_content').html(input);

   });
});
</script>
<script type="text/javascript">
  $('#parent').on('input',function(){
    var $input = $('#parent').val();
    if ($input == 3) {
      $('#job_family').removeClass('hidden');
    }else{
      $('#job_family').addClass('hidden');
    }
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="col-md-12" style="padding-bottom: 5px;"><h6>Trainer Name</h6><input type="text" class="form-control" style="width: 50%;" placeholder="name.." name="trainer_name[]"><h6>Trainer Info</h6><input type="text" class="form-control" style="width: 50%;" placeholder="info.." name="trainer_info[]"><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
    @include('admin.layouts.summernote')


@endsection