@extends('user.layouts.app')

@section('content')

    <div class="page-container" id="wrapper">
        <div class="page-sidebar navbar-collapse collapse">

            <ul class="page-sidebar-menu" data-auto-scroll="true" data-slide-speed="200">
                <li class="">
                    <a href="/">
                        Home
                    </a>
                </li>
                <li class="active"><a href="/news-board">News</a><span class="selected">
						</span></li>
            </ul>

        </div>
        <div class="page-content-wrapper" style="padding:30px">
            <div class ="col-md-8">
                <div class ="col-md-8">
                    <div class="col-md-3">
                        <br>
                        <img src="http://localhost/code_alc2/public/Uploads/KTP.png" alt="Card image cap" style="width:100%;height:60px;">
                    </div>
                    <div class ="col-md-9">
                        <h3>qwerty qwerty</h3>
                        <h6>Thursday 4th of January 2018</h6>
                    </div>
                </div>
                <div class ="col-md-12">
                    <hr class="style14">
                    <p align="justify" class="big">
                    <p><strong style="margin: 0px; padding: 0px; font-family: "Open Sans", Arial, sans-serif; text-align: justify;">Lorem Ipsum</strong><span style="font-family: "Open Sans", Arial, sans-serif; text-align: justify;"> adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi</span></p><p><span style="font-family: "Open Sans", Arial, sans-serif; text-align: justify;"><br></span></p><p><strong style="margin: 0px; padding: 0px; font-family: "Open Sans", Arial, sans-serif; text-align: justify;">Lorem Ipsum</strong><span style="font-family: "Open Sans", Arial, sans-serif; text-align: justify;"> adalah contoh teks atau dummy dalam industri percetakan dan penataan huruf atau typesetting. Lorem Ipsum telah menjadi standar contoh teks sejak tahun 1500an, saat seorang tukang cetak yang tidak dikenal mengambil sebuah kumpulan teks dan mengacaknya untuk menjadi sebuah buku contoh huruf. Ia tidak hanya bertahan selama 5 abad, tapi</span><span style="font-family: "Open Sans", Arial, sans-serif; text-align: justify;"><br></span><br></p><p><iframe frameborder="0" src="//www.youtube.com/embed/7UzgC3KFfaE" width="640" height="360" class="note-video-clip"></iframe><br></p>

                    </p>
                    <hr class="style14">
                    <div class='pull-right'>
                        Attachments : <br>
                        <a href="http://localhost/code_alc2/public/Uploads/1491912992_cloud.png"><i class="fa fa-paperclip" aria-hidden="true"></i>1491912992_cloud.png </a><br>
                        <a href="http://localhost/code_alc2/public/Uploads/1491912582_Mercedes_Coach.png"><i class="fa fa-paperclip" aria-hidden="true"></i>1491912582_Mercedes_Coach.png </a><br>
                    </div>
                    <br><br><br><br>

                    <div class="block-advice">
                        <h3>Comments(0)</h3>
                        <br>


                    </div>
                </div>
            </div>

            <div class="col-lg-4  col-md-4 col-sm-12 hidden-sm hidden-xs">
                <div id="navWrap">
                    <nav>
                        <div class ="fixedpositiion">
                            <div class="well">
                                <h4>Recent News</h4>
                                <hr class="style14">
                                <a href="/news/9"><p>qwerty qwerty</p></a>
                                <a href="/news/8"><p>fsdf</p></a>
                                <a href="/news/7"><p>wqewq</p></a>
                                <a href="/news/6"><p>efer</p></a>
                                <a href="/news/5"><p>trewq</p></a>
                                <a href="/news/4"><p>news</p></a>
                                <br>
                            </div>
                            <!--Links -->
                            <p class="border-panel-title-wrap">
                                <span class="panel-title-text">Links</span>
                            </p>
                            <div class="row">
                                <div class="col-md-12 clearfix">
                                    <a href="#" class="btn btn-lg default" style="margin:5px 1px">
                                        IMS
                                    </a>
                                    <a href="#" class="btn btn-lg red" style="margin:5px 1px">
                                        IMS
                                    </a>
                                    <a href="#" class="btn btn-lg blue" style="margin:5px 1px">
                                        IMS
                                    </a>
                                    <a href="#" class="btn btn-lg green" style="margin:5px 1px">
                                        IMS
                                    </a>
                                    <a href="#" class="btn btn-lg yellow" style="margin:5px 1px">
                                        IMS
                                    </a>
                                    <a href="#" class="btn btn-lg purple" style="margin:5px 1px">
                                        IMS
                                    </a>
                                    <a href="#" class="btn btn-lg green" style="margin:5px 1px">
                                        IMS
                                    </a>
                                    <a href="#" class="btn btn-lg dark" style="margin:5px 1px">
                                        IMS
                                    </a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>

        </div>


@endsection