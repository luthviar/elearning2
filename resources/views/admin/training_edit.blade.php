@extends('admin.layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Training
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/personnel')}}">Training</a></li>
        <li class="active">Add Training</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add Training</h3>
            </div>
            <div class="box-body">

            <form action="{{url('edit_training_submit')}}" method="post">
              {{ csrf_field() }}

              <input type="hidden" name="id_module" value="{{$module->id}}">
            
              <!-- Title -->
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="modul_name" value="{{$module->modul_name}}" placeholder="Training title">
              </div>


              <!-- select -->
                <div class="form-group col-md-4">
                  <label>Training Parent</label>
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
                <label>Training Date:</label>

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
                  <label>Training Start:</label>

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
                <div class="form-group col-md-4" id="department">
              @else
                <div class="form-group col-md-4 hidden" id="department">
              @endif
                  <label>Department</label>
                  <select class="form-control" name="id_department" >
                    @foreach($department as $dept)
                    @if($dept->id == $module->id_department)
                    <option value="{{$dept->id}}" selected="true">{{ $dept->department_name}}</option>
                    @else
                    <option value="{{$dept->id}}">{{ $dept->department_name}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
                </div>

              <!-- Textarea -->
              <div class="form-group">
                  <label>Training Overview</label>
                  <textarea class="textarea" id="content" name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$module->description}}</textarea>
              </div>

              <div class="row text-center">
                <button class="btn btn-success">Submit</button>
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
      $('#department').removeClass('hidden');
    }else{
      $('#department').addClass('hidden');
    }
  });
</script>



@endsection