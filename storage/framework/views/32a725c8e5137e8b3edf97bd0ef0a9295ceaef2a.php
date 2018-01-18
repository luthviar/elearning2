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