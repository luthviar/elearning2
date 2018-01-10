@extends('admin.layouts.app')

@section('page-name')
    Manage Chapter Training
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-12">
      <div class="box box-primary">

            <div class="box-header">
              <h3 class="box-title">Select True Answer</h3>
            </div>

            <div class="box-body">
                 <form action="{{url(action('TrainingController@select_answer_submit'))}}" method="post">
                   {{csrf_field()}}
                 
                 <h5>Question :</h5>
                 <p>{!! html_entity_decode($question->question_text) !!}</p>
                <!-- select -->
                <div class="form-group col-md-12">
                  <label>Select True Answer</label>
                  <select class="form-control" name="true_answer">
                  @if(count($question['option']) >0)
                  @foreach($question['option'] as $option)
                    <option value="{{$option->id}}">{{$option->option_text}}</option>
                  @endforeach
                  @endif
                  </select>
                </div>

                <div class="col-md-12 text-center">
                 <input type="submit" name="submit" class="btn btn-default">
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


@endsection