@extends('admin.layouts.app')

@section('content')

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add News
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{url('/personnel')}}">News</a></li>
        <li class="active">Edit News</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">

    <form method="post" action="{{url('news_edit_submit')}}" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">
      

      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add News</h3>
            </div>
            <div class="box-body">
              {{csrf_field()}}

              <input type="hidden" name="id_news" value="{{$news->id}}">
              <!-- Title -->
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" value="{{$news->title}}" name="title" placeholder="News title">
              </div>

              <div class="col-md-12">
              <!-- Image -->
              <div class="form-group col-md-6">
                  <label for="exampleInputFile">Image Thumbnail</label>
                  <p style="color: red;">* your previous image will deleted if you choose image again</p>
                  <input type="file" id="img" name="image">
              </div>

              <div class="form-group col-md-6">
                  <label>Can Reply ?</label>
                  <select class="form-control" name="can_reply">
                    @if($news->is_reply == 1)
                    <option value="1" selected="true">Ya</option>
                    <option value="0">Tidak</option>
                    @else
                    <option value="1">Ya</option>
                    <option value="0" selected="true">Tidak</option>
                    @endif
                  </select>
              </div>
              </div>

              <!-- Textarea -->
              <div class="form-group">
                  <label>Textarea</label>
                  <textarea class="textarea" id="summernote" name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;">{{$news->content}}</textarea>
              </div>

              <div class="form-group">
                  <label>Attachment</label>
                  <p style="color: red">* your previous attachment will deleted if you choose attachment again</p>
                  <input type="file" name="attachment[]" id="file" multiple 
                      onchange="javascript:updateList()" />
              </div>

              


            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <div class="col-md-6">
      

          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Preview News</h3>
             </div> 
            
            <div class="box-body">
                <!-- CONTENT -->
                <div id="news_content">
                  <div class="col-xs-12 col-sm-6 col-md-4">
                    <img id="img_prev" src="{{ URL::asset($news->url_image)}}" style="width: 100%; height: 100px;">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-8">
                    <h3><strong id="preview_news_title">{{$news->title}}</strong></h3>
                  </div>
                  
                  <div id="preview_news_content">
                    {!! html_entity_decode($news->content) !!}
                  </div>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                        <div id="file_list">
                          <ul>
                          @foreach($news['attachments'] as $file)
                            <li><a href="{{url::asset($file->attachment_url)}}">{{$file->attachment_name}}</a></li>
                          @endforeach
                          </ul>
                        </div>
                  </div>
                </div>
              
            </div>
          </div>
          <!-- /.box -->

        </div>
    </div>
    <div class="row text-center">
      <button class="btn btn-success">submit</button>
    </div>
    </form>


    </section>
    <!-- /.content -->


@endsection

@section('script')
<script src="{{URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script>

  // $(function () {
    
  //   //bootstrap WYSIHTML5 - text editor
  // var editor =  $(".textarea").wysihtml5({
  //     toolbar: {
  //       "font-styles": true, // Font styling, e.g. h1, h2, etc.
  //       "emphasis": true, // Italics, bold, etc.
  //       "lists": false, // (Un)ordered lists, e.g. Bullets, Numbers.
  //       "html": false, // Button which allows you to edit the generated HTML.
  //       "link": true, // Button to insert a link.
  //       "image": false, // Button to insert an image.
  //       "color": true, // Button to change color of font
  //       "blockquote": false, // Blockquote
        
  //     }
  //   });

  
  
  
  
  // });

</script>

<script type="text/javascript">
$(document).ready(function(){
  $('#title').on('input', function(){ 
    var input = $('#title').val();
    $('#preview_news_title').html(input);

   });
});
</script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>
 <script>
 $(document).ready(function() {
      $('#summernote').summernote({
        callbacks: {
          onChange: function(contents, $editable) {
            console.log('onChange:', contents, $editable);
            $('#preview_news_content').html(contents, $editable);
          }
        },
        height: 100,
        
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
<script type="text/javascript">
  updateList = function() {
  var input = document.getElementById('file');
  var output = document.getElementById('file_list');

  output.innerHTML = '<ul>';
  for (var i = 0; i < input.files.length; ++i) {
    output.innerHTML += '<li>' + input.files.item(i).name + '</li>';
  }
  output.innerHTML += '</ul>';
}
</script>


@endsection