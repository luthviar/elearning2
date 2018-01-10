 <html lang="en">

  <head>
    <meta charset="UTF-8">
    <!-- implement csrf token for AJAX calling -->
    <meta name="_token" content="Ieh2gwv35UFmwj7dFF5FxRyux9NRlYn7DXQQuU5w">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Elearning Aerofood</title>
    <link rel="icon" href="{{URL::asset('Elegantic/images/ALS.png')}}" type="image/jpg" sizes="16x16">

    <link rel="stylesheet" href="{{ url('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ url('onlinetest/style.css') }}">
    <link rel="stylesheet" href="{{ url('onlinetest/sweetalert.css') }}">
    <style>
      @font-face {
        font-family: 'ttbold';
        src: url('{{ url('onlinetest/TypeType-TTLakesCondensed-Bold.otf') }}');
      }

      .overflow-hidden {
        overflow: hidden;
      }

      #start-stage {
        border: none;
        padding: 0;
        width: 200px;
        margin: 0 auto;
        position: fixed;
        bottom: 40px;
        right: 60px;
      }

      #start-stage:active img {
        content: url('{{ url('onlinetest/btn-clicked-3.png') }}');
      }

      .rules-container {
        position: fixed;
        background-color: #4DAFE0;
        width: 603px;
        height: 396px;
        top: calc(50vh - 83px);
        left: calc(50vw - 579px);
        padding: 10px;
        overflow: auto;
      }

      li {
        margin-bottom: 12px;
      }

      #bet {
        position: fixed;
        bottom: 116px;
        right: 58px;
        height: 33px;
        width: 283px;
      }

      @media screen and (min-height: 768px) {
        #bet {
          position: fixed;
          bottom: 135px;
          right: 58px;
          height: 33px;
          width: 283px;
        }
      }
    </style>
    <script src="{{ url('js/ifvisible.js') }}"></script>
    <script>
        // If page is visible right now
        if( ifvisible.now() ){
            // Display pop-up
            ifvisible.on("blur", function(){
                // example code here..
                alert('anda tidak aktif');
//                animations.pause();
            });

            ifvisible.on("focus", function(){
                // resume all animations
                console.log('anda aktif lagi');
//                animations.resume();
            });
            console.log('anda aktif')
        }
    </script>
  </head>

  <body class="">

  <nav class="navbar navbar-default navbar-fixed-top text-white">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-10 col-md-offset-1">
          <div class="pull-left">
            <table class="nav-table">
              <tbody>
              <tr class="text-left">
                <th>Type of test</th>
                <th>Time left</th>
                <th>Hints</th>
              </tr>
              <tr>
                <td class="bg-blue">
                  <span class="text-white" style="font-size:24px; text-transform: capitalize;">
                    <b><i id="level-label">
                        {{$chapter->chapter_name}}
                      </i></b>
                  </span>
                </td>
                <td class="bg-yellow">
                  <div id="timer"
                       data-minutes-left="{{ $test->time }}"
                       class="text-white"
                       style="font-size:24px;font-weight:bold">{{ $test->time }}</div>
                </td>
                <td class="bg-red">
                      <span class="text-white">
                      Click 'A', 'B', 'C', or 'D' circle to choose an answer.
                  </span>
                </td>
              </tr>
              </tbody>
            </table>
          </div>

          <div class="pull-right">
            <div id="next-slide" class="stage32 circle bg-yellow pull-right">
              <span id="next-slide-arrow" style="font-size: 58px;position: relative;top: -16px;"
                    data-toggle="modal" data-target="#myModal"
              >»</span>
            </div>
            <div class="text-right pull-right" style="margin-right:12px;">

              <span id="slide-info" class="v-align-middle" style="font-size:24px;position: relative;top: 13px;">Submit</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>

  <div class="main-container container-fluid">

    <div class="row">
      <input type="hidden" id="total_question" value="{{count($test['questions'])}}">
      <div id="page_container" class="col-md-8 col-md-offset-2">
        <div class="question-list content">

          <form  id="test_form" action="{{ url('/test_submit') }}" method="post">
            {{ csrf_field() }}
          @foreach( $test['questions'] as $key => $question)
          <div class="question-list-item">

              <input type="hidden" name="id_chapter" value="{{ $chapter->id }}">


            <div>
              <h3>
                <b>
                  <span class="text-blue">Question no. </span>
                  <div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;">
                    <span class="v-align-sub text-white">{{ $key+1 }}</span>
                  </div>&nbsp;&nbsp;&nbsp;
                  <span class="text-capitalize"></span>
                </b>
              </h3>
              <input type="hidden" name="question_id" value="127">
              <div class="question">{!! $question->question_text  !!} </div>
              <br>
              <ol type="A" style="list-style:none">

                @foreach ($question['option'] as $keyopt => $option)
                <li>
                  <input type="radio"
                         name="{{$question->id}}"
                         onclick="count_answer({{$key}})"
                         id="{{$option['id']}}"
                         value="{{$option['id']}}">

                  <label for="{{$option['id']}}">
                    <div class="choice-circle text-white text-center bg-grey">
                      <span class="v-align-middle">{!!  $char++ !!}</span>
                    </div>&nbsp;{{ $option['option_text'] }}
                  </label>

                  <br>
                </li>
                @endforeach
                <div hidden>{{ $char = 'A'  }}</div>
              </ol>
            </div>

          </div>
            <hr>

          @endforeach
          </form>

        </div>
        <input type="hidden" name="paket_id" value="3">
        <input type="hidden" name="user_id" value="1">
      </div>
    </div>

  </div>

  <script>
      var server_time = "05 January 2018 02:11:29";
      var current_session_end = "2018-01-13 05:05:10";
  </script>
  <script src="{{ url('js/jquery.min.js') }}" defer="defer"></script>
  <script src="{{ url('onlinetest//moment.js') }}" defer="defer"></script>
  <script src="{{ url('onlinetest/moment-timezone.js') }}" defer="defer"></script>
  <script src="{{ url('js/bootstrap.min.js') }}" defer="defer"></script>
  <script>
      var finish = "http://iseec-ui.com/ISEEC/preliminary/online-test/finish";
  </script>
  <script src="{{ url('onlinetest/sweetalert.min.js') }}" defer="defer"></script>
  <script src="{{ url('onlinetest/timer.jquery.min.js') }}" defer="defer"></script>
  <script src="{{ url('onlinetest/security.js') }}" defer="defer"></script>
  <script src="{{ url('onlinetest/participant-script.js') }}" defer="defer"></script>
  <script language="JavaScript" type="text/javascript" defer="defer">
     var timelimit = {{ $test->time }} +"m";
  </script>
  <script src="{{ url('onlinetest/allstage.js') }}" defer="defer"></script>
  <script type="text/javascript">
      var answered = new Array();
      var total = 0;
      var in_answered = false;

      function count_answer( name ) {
          var total_question = document.getElementById('total_question').value;
          for (var i = answered.length - 1; i >= 0; i--) {
              if ( answered[i] == name) {
                  in_answered = true;
              }
          }
          if (!in_answered) {
              answered.push(name);
              total += 1;
          }
          if (in_answered) {
              in_answered = false;
          }
          var total_answered = document.getElementById('total_answered');
          total_answered.innerHTML= 'Total Answered : '+ total;
          var not_answered = document.getElementById('not_answered');
          not_answered.innerHTML= 'Total Empty Answer : '+ (total_question-total);

      }
  </script>
  <script type="text/javascript">
      function submit_test(){
          $('#test_form').submit();
      }
  </script>

  <script>
//      script menghapus navbar
      var parent = document.getElementById("div1");
      var child = document.getElementById("p1");
      parent.removeChild(child);

//      script menghapus footer
      var parent2 = document.getElementById("div2");
      var child2 = document.getElementById("p2");
      parent2.removeChild(child2);
  </script>
  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h1 class="modal-title text-center" id="myModalLabel"><strong>Are you serious to submit ?</strong></h1>
        </div>
        <div class="modal-body text-center">
          <h5>Total Question : {{ count($test['questions']) }}</h5>
          <h5 id="total_answered"></h5>
          <h5 id="not_answered"></h5>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" id="submit_button" onclick="submit_test()" class="btn btn-primary">Submit Test</button>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
      $(document).ready(function(){
          history.pushState(null, null, document.URL);
          window.addEventListener('popstate', function () {
              history.pushState(null, null, document.URL);
          });
          document.addEventListener('contextmenu', event => event.preventDefault());
          //keyboard not run
          document.onkeydown = function (e) {
              return false;
          }
      });
  </script>

  <script>
//    this script prevent user from close page
      window.onbeforeunload = function () {
          return "Apakah Anda yakin?";
      };

//      this function is prevent user from back page
      (function (global) {

          if(typeof (global) === "undefined") {
              throw new Error("window is undefined");
          }

          var _hash = "!";
          var noBackPlease = function () {
              global.location.href += "#";

              // making sure we have the fruit available for juice (^__^)
              global.setTimeout(function () {
                  global.location.href += "!";
              }, 50);
          };

          global.onhashchange = function () {
              if (global.location.hash !== _hash) {
                  global.location.hash = _hash;
              }
          };

          global.onload = function () {
              noBackPlease();

              // disables backspace on page except on input fields and textarea..
              document.body.onkeydown = function (e) {
                  var elm = e.target.nodeName.toLowerCase();
                  if (e.which === 8 && (elm !== 'input' && elm  !== 'textarea')) {
                      e.preventDefault();
                  }
                  // stopping event bubbling up the DOM tree..
                  e.stopPropagation();
              };
          }

      })(window);
  </script>


  </body>

  </html>