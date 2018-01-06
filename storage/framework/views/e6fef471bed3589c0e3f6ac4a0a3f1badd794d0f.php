<?php $__env->startSection('content'); ?>

  <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Add News
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="<?php echo e(url('/personnel')); ?>">News</a></li>
        <li class="active">Add News</li>
      </ol>
    </section>



    <!-- Main content -->
    <section class="content">
    <div class="row">
      <div class="col-md-6">
      

      <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Add News</h3>
            </div>
            <div class="box-body">

              <!-- Title -->
              <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" id="title" placeholder="News title">
              </div>


              <!-- Image -->
              <div class="form-group">
                  <label for="exampleInputFile">Image Thumbnail</label>
                  <input type="file" id="exampleInputFile" >
              </div>

              <!-- Textarea -->
              <div class="form-group">
                  <label>Textarea</label>
                  <textarea class="textarea" id="summernote" name="content" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
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
                    <img src="<?php echo e(URL::asset('gambar.png')); ?>" style="width: 100%; height: 100px;">
                  </div>
                  <div class="col-xs-12 col-sm-6 col-md-8">
                    <h3><strong id="preview_news_title">News Title</strong></h3>
                  </div>
                  
                  <p id="preview_news_content">waiting for content text</p>

                  <!-- Attachments -->
                  <div>
                    <h5><strong>Attachments : </strong></h5>
                        <h6 style="text-indent: 20px;">* attachment 1</h6>
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


    </section>
    <!-- /.content -->


<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
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
$(document).ready(function(){
  $('#content').on('input', function(){ 
    var input = $('#content').val();
    $('#preview_news_content').html(input);

   });
});
</script>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.layout_admin', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>