@extends('layout')

@section('content')

<!-- ********************************************** -->
<!--                  POST                          -->
<!-- ********************************************** -->

  <div class="row" style="padding-top: 20px;">
    <div class="container">
      <!-- News Content and Comments-->
      <div class="col-xs-12 col-sm-6 col-md-8" style="padding-bottom: 20px;">
        <!-- CONTENT -->
        <div id="news_content">
          <div class="col-xs-12 col-sm-6 col-md-4">
            <img src="gambar.png" style="width: 100%; height: 150px;">
          </div>
          <div class="col-xs-12 col-sm-6 col-md-8">
            <h3><strong>Ini Bagian Judul Berita</strong></h3>
            <h6><strong>Created at adiasdasdsadsad</strong> . 10x seen by user</h6>  
          </div>
          
          <p>Screen readers will have trouble with your forms if you don't include a label for every input. For these inline forms, you can hide the labels using the .sr-only class. There are further alternative methods of providing a label for assistive technologies, such as the aria-label, aria-labelledby or title attribute. If none of these is present, screen readers may resort to using the placeholder attribute, if present, but note that use of placeholder as a replacement for other labelling methods is not advised.</p>
          <p>Screen readers will have trouble with your forms if you don't include a label for every input. For these inline forms, you can hide the labels using the .sr-only class. There are further alternative methods of providing a label for assistive technologies, such as the aria-label, aria-labelledby or title attribute. If none of these is present, screen readers may resort to using the placeholder attribute, if present, but note that use of placeholder as a replacement for other labelling methods is not advised.</p>

          <!-- Attachments -->
          <div>
            <h5><strong>Attachments :</strong></h5>
            <h6 style="text-indent: 20px;">1. Attachments 1</h6>
            <h6 style="text-indent: 20px;">2. Attachments 2</h6>
          </div>
        </div>

        <!-- COMMENTS -->
        <div id="news_comments">
          <h3><strong>Comments</strong></h3>
          <br>
          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object" src="gambar.png" alt="..." style="width: 100px">
              </a>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Media heading</h4>
              <h6>Alexander John, at 1212 121 </h6>
              <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.  </p>
              <div>
                <h6><strong>Attachments :</strong></h6>
                <h6 style="text-indent: 20px;">1. Attachments 1</h6>
                <h6 style="text-indent: 20px;">2. Attachments 2</h6>
              </div>
            </div>
          </div>

          <div class="media">
            <div class="media-left">
              <a href="#">
                <img class="media-object" src="gambar.png" alt="..." style="width: 100px">
              </a>
            </div>
            <div class="media-body">
              <h4 class="media-heading">Media heading</h4>
              <h6>Alexander John, at 1212 121 </h6>
              <p>Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.</p>
              <div>
                <h6><strong>Attachments :</strong></h6>
                <h6 style="text-indent: 20px;">1. Attachments 1</h6>
                <h6 style="text-indent: 20px;">2. Attachments 2</h6>
              </div>
            </div>
          </div>

          <div style="padding-top: 20px;">
            <input type="text" class="form-control" placeholder="Comments Title">
            <textarea class="form-control" rows="3"></textarea><br>
            <button class="btn btn-default" type="submit">Button</button>
          </div>
        </div>
      </div>
      
      <!-- List Last News Post -->
      <div class="col-xs-12 col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">Other News</div>
          <div class="panel-body">
            news 1 <br>
            news 2 <br>
            news 3 <br>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection