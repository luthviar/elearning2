@extends('admin.layouts.app')

@section('page-name')
    <a href="{{ url(action('TrainingController@manage_training',$module->id)) }}">
        <i class="fa fa-arrow-left"></i>
    </a>
    Add Chapter Training
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add Chapter</h3>
            </div>
            <div class="box-body">

                 <form action="{{url(action('TrainingController@add_chapter_submit'))}}" method="post">
                 {{csrf_field()}}
                  <input type="hidden" name="id_module" value="{{$module->id}}">
                  
                  <div class="col-md-12">
                  <!-- Title -->
                  <div class="form-group col-md-4">
                    <label for="title">Chapter Name</label>
                    <input type="text" class="form-control" name="chapter_name" id="title" placeholder="Chapter title">
                  </div>
                    <!-- select -->
                  <div class="form-group col-md-4">
                    <label>Chapter Type</label>
                    <select class="form-control" id="add_chapter_type" name="category">
                      <option value="0">Material</option>
                      <option value="1">Test</option>
                    </select>
                  </div>

                  <!-- Title -->
                  <div class="form-group col-md-4 hidden" id="test_time">
                    <label for="time">Test Time</label>
                    <input type="text" class="form-control" name="time" id="time" placeholder="in minutes">
                  </div>
                  </div>

                    <!-- Textarea -->
                  <div class="form-group">
                      <label>Chapter Description</label>
                      <textarea class="textarea" id="summernote" name="description" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                    
                  <div class="col-md-12 text-center">
                   <input type="submit" name="submit" class="btn btn-default">
                  </div>
                  </form> 

                    </div>
                    <!-- /.box-body -->
                  </div>

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
  $('#add_chapter_type').on('input', function(){
      var chapter_type = $('#add_chapter_type').val();
    if (chapter_type == 0) {
      // material form load
      $('#test_time').addClass('hidden');
    } else {
      // test form load
      $('#test_time').removeClass('hidden');
    }
  });
</script>
<script type="text/javascript">
  //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    });
    //Timepicker
    $(".timepicker").timepicker({
      showInputs: false
    });


</script>
@include('admin.layouts.summernote')

<!-- <script src="{{URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
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

</script>
 -->
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


@endsection