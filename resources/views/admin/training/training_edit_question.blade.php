@extends('admin.layouts.app')

@section('page-name')
    <a href="{{ url(action('TrainingController@manage_chapter',Session::get('id_chapter'))) }}">
        <i class="fa fa-arrow-left"></i>
    </a>
    Manage Chapter Training
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Edit Question
                  <i class="fa fa-info-circle"
                     style="color: red;"
                     data-toggle="tooltip"
                     data-placement="top"
                     title="Question content and option should not empty."
                  ></i>
              </h3>
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
            </div>
            <div class="box-body">
                 <form action="{{url(action('TrainingController@edit_question_submit'))}}" method="post">
                   {{csrf_field()}}
                 
                  <input type="hidden" name="question_id" value="{{$question->id}}">
                 <div class="form-group">
                    <label>Question*:</label>
                     <textarea class="textarea" id="summernote"
                               name="question_text" placeholder="add question here" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $question->question_text !!}</textarea>
                    {{--<textarea class="textarea" id="summernote" name="question_text" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{!! $question->question_text !!}</textarea>--}}
                </div>
                
                  <h5><strong>Options*:</strong>
                      <span><button class="add_field_button btn btn-success">+ Add More Option</button></span>
                  </h5>
                  <div class="input_fields_wrap col-md-12" style="padding-top: 10px;">
                    @foreach ($question['option'] as $key => $option)
                    @if($key < 2)
                    <div class="col-md-12" style="padding-bottom: 5px;">
                        <input type="text" class="form-control" value="{{$option->option_text}}" style="width: 80%;"
                               placeholder="input option" name="option[]" required>
                    </div>
                    @else
                    <div class="col-md-12" style="padding-bottom: 5px;"><input type="text" class="form-control" value="{{$option->option_text}}" style="width: 80%;" placeholder="input option" name="option[]"><a href="#" class="remove_field">Remove</a></div>
                    @endif
                    @endforeach
                  </div>

                <div class="col-md-12 text-center">
                 <button type="submit" name="submit" class="btn btn-block btn-info">
                     <i class="fa fa-save" aria-hidden="true"></i>
                     Update This Question
                 </button>
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
            $(wrapper).append('<div class="col-md-12" style="padding-bottom: 5px;"><input type="text" style="width: 80%;" class="form-control" placeholder="input option" name="option[]" required/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

@include('admin.layouts.summernote')
@endsection