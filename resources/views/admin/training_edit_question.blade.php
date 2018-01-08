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
              <h3 class="box-title">Edit Question</h3>
            </div>
            <div class="box-body">
                 <form action="{{url('edit_question_submit')}}" method="post">
                   {{csrf_field()}}
                 
                  <input type="hidden" name="question_id" value="{{$question->id}}">
                 <div class="form-group">
                    <label>Question</label>
                    <textarea class="textarea" name="question_text" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$question->question_text}}</textarea>
                </div>
                <div class="col-md-12">
                  @foreach ($question['option'] as $key => $option)
                  <div class="form-group">
                    <label for="title">Option {{$key+1}}</label>
                    <input type="text" class="form-control" name="option{{$key+1}}" value="{{$option->option_text}}">
                  </div>
                  @endforeach
                  
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