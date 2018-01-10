<?php $__env->startSection('page-name'); ?>
Add News
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- Main content -->
    <section class="content">

    <form method="post" action="<?php echo e(URL::action('NewsController@news_add_submit')); ?>" enctype="multipart/form-data">
    <div class="row">
      <div class="col-md-6">
      

      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add News</h3>
            </div>
            <div class="box-body">
              <?php echo e(csrf_field()); ?>


            
              <!-- Title -->
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" placeholder="News title" required ="true">
              </div>


              <!-- Image -->
              <div class="form-group col-md-6">
                  <label for="exampleInputFile">Image Thumbnail</label>
                  <input type="file" id="img" name="image">
              </div>

              <div class="form-group col-md-6">
                  <label>Can Reply ?</label>
                  <select class="form-control" name="can_reply">
                    <option value="1">Ya</option>
                    <option value="0">Tidak</option>
                  </select>
              </div>

              <!-- Textarea -->
              <div class="form-group">
                  <label>Textarea</label>
                  <textarea class="textarea" id="summernote" name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" required ="true"></textarea>
              </div>

              <div class="form-group">
                  <label>Attachment</label>
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
                    <img id="img_prev" src="<?php echo e(URL::asset('gambar.png')); ?>" style="width: 100%; height: 100px;">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-8">
                    <h3><strong id="preview_news_title">News Title</strong></h3>
                  </div>
                  
                  <div id="preview_news_content">
                    Waiting for input content
                  </div>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                        <div id="file_list"></div>
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


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	<?php echo $__env->make('admin.layouts.summernote', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script src="<?php echo e(URL::asset('AdminLTE/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')); ?>"></script>
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


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>