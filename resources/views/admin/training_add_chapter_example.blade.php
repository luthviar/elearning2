@extends('admin.layout_admin')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add Chapter Training
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/personnel')}}">Training</a></li>
        <li class="active">Add Chapter Training</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add Chapter</h3>
            </div>
            <div class="box-body">

                  <!-- Title -->
                  <div class="form-group col-md-6">
                    <label for="title">Chapter Name</label>
                    <input type="text" class="form-control" id="title" name="title" id="title" placeholder="Training title">
                  </div>
                    <!-- select -->
                  <div class="form-group col-md-6">
                    <label>Chapter Type</label>
                    <select class="form-control" id="add_chapter_type">
                      <option value="0">Material</option>
                      <option value="1">Test</option>
                    </select>
                  </div>
                    <!-- Textarea -->
                  <div class="form-group">
                      <label>Chapter Description</label>
                      <textarea class="textarea" id="content" name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                  </div>
                    
                  <!-- ADD MATERIAL  -->
                  <div class="box box-success text-left col-md-6" id="add_material_form">
                    <div class="box-header">
                      <h3 class="box-title">Add Material Attachments</h3>  
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <!-- MATERIAL UPLOADED -->
                        <div class="box box-success col-md-6">
                          <div class="box-body">
                            <h5>Material Uploaded</h5>
                            <p>
                              <a href="" class="btn btn-default" style="width: 90%">attachment 1</a><span class="pull-right"><i class="fa fa-times" style="color: red" aria-hidden="true">remove</i></span>
                              <a href="" class="btn btn-default" style="width: 90%">attachment 2</a><span class="pull-right"><i class="fa fa-times" style="color: red" aria-hidden="true">remove</i></span>
                              <a href="" class="btn btn-default" style="width: 90%">attachment 3</a><span class="pull-right"><i class="fa fa-times" style="color: red" aria-hidden="true">remove</i></span>
                            </p>
                          </div>
                          <!-- /.box-body -->
                        </div>

                        <!-- UPLOAD MATERIAL FORM -->
                        <div class="box box-warning col-md-6">

                          <!-- /.box-header -->
                          <div class="box-body">
                            <h5>Form Upload</h5>
                            <!-- Title -->
                            <div class="form-group col-md-6">
                              <label for="title">Attachment Name</label>
                              <input type="text" class="form-control" id="title" name="title" id="title" placeholder="Attachment Name">
                            </div>

                            <!-- File -->
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile">Image Thumbnail</label>
                                <input type="file" id="exampleInputFile" accept=".pdf">
                            </div>
                            <div class="form-group col-md-12 text-center">
                              <input type="submit" name="submit" class="btn btn-info">
                            </div>
                          </div>
                          <!-- /.box-body -->
                        </div>

                    </div>
                    <!-- /.box-body -->
                  </div>


                  <!-- ADD TEST QUESTION AND ANSWER -->
                    <div class="box box-warning text-left hidden" id="add_test_form">
                    <div class="box-header">
                      <h3 class="box-title">Test Question</h3> 
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul style="list-style-type: none;">
                        <li>1. Siapakah presiden kita ? <span class="pull-right" style="color: red"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit</i> <i class="fa fa-times" aria-hidden="true">remove</i></span>
                          <ul style="list-style-type: none;">
                            <li><input type="radio" name="optionsRadios" value="option1" checked>
                                Option one is this and that&mdash;be sure to include why it's great
                                <span style="color: green"><i class="fa fa-check" aria-hidden="true"></i> true answer</span></li>
                            <li><input type="radio" name="optionsRadios" value="option1">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                            <li><input type="radio" name="optionsRadios" value="option1">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                          </ul>
                        </li>
                        <li>2. Berapa harga cabe sekarang ? <span class="pull-right" style="color: red"><i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit</i> <i class="fa fa-times" aria-hidden="true">remove</i></span>
                          <ul style="list-style-type: none;">
                            <li><input type="radio" name="optionsRadios2" value="option2" checked>
                                Option one is this and that&mdash;be sure to include why it's great
                                <span style="color: green"><i class="fa fa-check" aria-hidden="true"></i> true answer</span></li>
                            <li><input type="radio" name="optionsRadios2" value="option2">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                            <li><input type="radio" name="optionsRadios2" value="option2">
                                Option one is this and that&mdash;be sure to include why it's great</li>
                          </ul>
                        </li>
                      </ul>

                      <!-- FORM ADD QUESTION -->
                      <h5>Add Question</h5>
                      <!-- Question -->
                      <div class="form-group">
                          <label>Question</label>
                          <textarea class="textarea" ame="question" placeholder="add question here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </div>
                      <!-- Option -->
                      <div class="col-md-6">
                      <div class="form-group">
                        <label for="title">Option 1</label>
                        <input type="text" class="form-control" id="title" name="title" id="title" placeholder="Option 1">
                      </div>
                      <div class="form-group">
                        <label for="title">Option 2</label>
                        <input type="text" class="form-control" id="title" name="title" id="title" placeholder="Option 2">
                      </div>
                      <div class="form-group">
                        <label for="title">Option 3</label>
                        <input type="text" class="form-control" id="title" name="title" id="title" placeholder="Option 3">
                      </div>
                      </div>
                      <div class="col-md-6">
                        <!-- select -->
                        <div class="form-group col-md-12">
                          <label>Select True Answer</label>
                          <select class="form-control" id="add_chapter_type">
                            <option value="0">Material</option>
                            <option value="1">Test</option>
                          </select>
                        </div>
                      </div>
                      <div class="col-md-12 text-center">
                       <input type="submit" name="submit" class="btn btn-default">
                      </div>



                    </div>
                    <!-- /.box-body -->
                  </div>


                  <div class="row text-center">
                    <button class="btn btn-success">Save Chapter</button>
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
      $('#add_test_form').addClass('hidden');
      $('#add_material_form').removeClass('hidden');
    } else {
      // test form load
      $('#add_test_form').removeClass('hidden');
      $('#add_material_form').addClass('hidden');
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

<script src="{{URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
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