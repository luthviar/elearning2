@extends('admin.layout_admin')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Manage Chapter Training
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/personnel')}}">Training</a></li>
        <li class="active">Manage Chapter Training</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Manage Chapter</h3> <span class="pull-right">
                          <a href="{{url('edit_chapter',$chapter->id)}}">
                            <i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit_chapter_overview</i>
                            </a> 
                          <a href="{{url('remove_chapter',$chapter->id)}}">
                            <i class="fa fa-times" style="color: red" aria-hidden="true">remove_chapter</i>
                          </a></span>

            </div>
            <div class="box-body">
            <div class="text-center">
                  <!-- Title -->
                  <h4> {{$chapter->chapter_name}}</h4>
                    <!-- select -->
                  @if($chapter->category == 0)
                  <h5>Chapter Category : Material</h5>
                  <p>{!! html_entity_decode($chapter['material']->description) !!}</p>
                  @else
                  <h5>Chapter Type : Test</h5>
                  <h5>Test Time : {{$chapter['test']->time}} minutes</h5>
                  <p>{!! html_entity_decode($chapter['test']->description) !!}</p>
                  @endif
            </div>
                  
                  @if($chapter->category == 0)
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
                            <h5><strong>Material Uploaded</strong></h5>
                            <p>
                              @if (count($chapter['material']['files_material']) == 0)
                              no material uploaded
                              @else
                              @foreach ( $chapter['material']['files_material'] as $file)
                              <a href="{{URL::asset($file->url)}}" class="btn btn-default" style="width: 90%">{{$file->name}}</a><span class="pull-right">
                              <a href="{{url('remove_material_file', $file->id)}}"><i class="fa fa-times" style="color: red" aria-hidden="true">remove</i></a></span>
                              @endforeach
                              @endif
                            </p>
                          </div>
                          <!-- /.box-body -->
                        </div>

                        <!-- UPLOAD MATERIAL FORM -->
                        <div class="box box-warning col-md-6">

                          <!-- /.box-header -->
                          <div class="box-body">
                          <form method="post" action="{{url('material_add')}}" enctype="multipart/form-data">
                            <h5>Form Upload</h5>
                            <!-- Title -->
                            <input type="hidden" name="id_material" value="{{$chapter['material']->id}}">

                            {{csrf_field()}}
                            <div class="form-group col-md-6">
                              <label for="title">Attachment Name</label>
                              <input type="text" class="form-control" name="attachment_name" id="title" placeholder="Attachment Name">
                            </div>

                            <!-- File -->
                            <div class="form-group col-md-6">
                                <label for="exampleInputFile">Image Thumbnail</label>
                                <input type="file" id="exampleInputFile" name="file" accept=".pdf">
                            </div>
                            <div class="form-group col-md-12 text-center">
                              <input type="submit" name="submit" class="btn btn-info">
                            </div>
                            </form>
                          </div>
                          <!-- /.box-body -->
                        </div>

                    </div>
                    <!-- /.box-body -->
                  </div>

                  @else
                  <!-- ADD TEST QUESTION AND ANSWER -->
                    <div class="box box-warning text-left" id="add_test_form">
                    <div class="box-header">
                      <h3 class="box-title">Test Question</h3> 
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <ul style="list-style-type: none;">
                        @if(count($chapter['test']['questions']) == 0)
                        no question
                        @else
                        @foreach($chapter['test']['questions'] as $key => $question)
                        <li>{{$key + 1}}. {{$question->question_text}} 
                        <span class="pull-right">
                          <a href="{{url('edit_question',$question->id)}}">
                            <i style="color:orange;" class="fa fa-pencil-square-o" aria-hidden="true">edit</i>
                            </a> 
                          <a href="{{url('remove_question',$question->id)}}">
                            <i class="fa fa-times" style="color: red" aria-hidden="true">remove</i>
                          </a></span>
                          <ul style="list-style-type: none;">
                            @foreach($question['option'] as $option)
                            @if($option->is_true == 1)
                            <li><input type="radio" name="{{$question->id}}" checked>
                                {!! html_entity_decode($option->option_text) !!}
                                <span style="color: green"><i class="fa fa-check" aria-hidden="true"></i> true answer</span></li>
                            @else
                            <li><input type="radio" name="{{$question->id}}" value="option1">
                               {!! html_entity_decode($option->option_text) !!}</li>
                            @endif
                            @endforeach
                          </ul>
                        </li>
                        @endforeach
                        @endif
                      </ul><br>

                      <!-- FORM ADD QUESTION -->
                      <h5><strong>Add Question</strong></h5>
                      <form action="{{url('add_question_submit')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="id_chapter" value="{{$chapter->id}}">
                        <input type="hidden" name="id_test" value="{{$chapter['test']->id}}">

                      <!-- Question -->
                      <div class="form-group">
                          <label>Question</label>
                          <textarea class="textarea" name="question_text" placeholder="add question here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
                      </div>
                      <!-- Option -->
                      <h5><strong>Options</strong></h5>
                      <button class="add_field_button btn btn-default">Add More Fields</button>
                      <div class="input_fields_wrap col-md-12" style="padding-top: 10px;">
                        <div class="col-md-12" style="padding-bottom: 5px;"><input type="text" class="form-control" style="width: 80%;" placeholder="input option" name="option[]"></div>
                        <div class="col-md-12" style="padding-bottom: 5px;"><input type="text" class="form-control" style="width: 80%;"  placeholder="input option" name="option[]"></div>
                      </div>
                      
                      <div class="col-md-12 text-center">
                       <input type="submit" name="submit" class="btn btn-default">
                      </div>
                      </form>
                      @endif


                    </div>
                    <!-- /.box-body -->
                  </div>


                  <div class="row text-center">
                    <a href="{{url('manage_training',$chapter->id_module)}}" class="btn btn-success">Save Chapter</a>
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
  $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div class="col-md-12" style="padding-bottom: 5px;"><input type="text" style="width: 80%;" class="form-control" placeholder="input option" name="option[]"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>


@endsection