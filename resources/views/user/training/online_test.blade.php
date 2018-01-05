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
              {{--<button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">--}}
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
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">1</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="126">
              <div class="question">The quantitative information is one which concerns the…</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="126[]" id="126_a" value="a">
                  <label for="126_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;Value of some variable</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="126[]" id="126_b" value="b">
                  <label for="126_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;Rate of change</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="126[]" id="126_c" value="c">
                  <label for="126_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;Condition or status of a system</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="126[]" id="126_d" value="d">
                  <label for="126_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;Presence or absence of some specific object</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          {{--@foreach( $test['questions'] as $key => $question)--}}
            {{--<div class="question-list-item">--}}
              {{--<li style="list-style-type: none;">{{ $key+1 }}. {{ $question->question_text }}--}}
          {{--<ul>--}}
          {{--@foreach ($question['option'] as $option)--}}
          {{--<li style="list-style-type: none;">--}}
          {{--<input type="radio"--}}
          {{--onclick="count_answer({{$key}})"--}}
          {{--name="{{$question->id}}"--}}
          {{--value="{{$option['id']}}"> {{ $option['option_text'] }}--}}
          {{--</li>--}}
          {{--@endforeach--}}
          {{--</ul>--}}
          {{--</li>--}}
            {{--</div>--}}
          {{--@endforeach--}}

          @foreach( $test['questions'] as $key => $question)
          <div class="question-list-item">
            <form  id="test_form" action="{{ url('/test_submit') }}" method="post">
              <input type="hidden" name="id_chapter" value="{{ $chapter->id }}">

              {{ csrf_field() }}
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
              <div class="question">{{ $question->question_text }}</div>
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
              </ol>
            </div>
            </form>
          </div>
            <hr>

          @endforeach

          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">3</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="128">
              <div class="question">Which one of these is not the components of speech communication systems?</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="128[]" id="128_a" value="a">
                  <label for="128_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;Speaker</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="128[]" id="128_b" value="b">
                  <label for="128_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;Word characteristics</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="128[]" id="128_c" value="c">
                  <label for="128_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;Articulation index</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="128[]" id="128_d" value="d">
                  <label for="128_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;Context features</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">4</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="129">
              <div class="question">There are options for restructuring the supply chain. A characteristic of vertical integration is:</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="129[]" id="129_a" value="a">
                  <label for="129_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;Close relationships with suppliers</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="129[]" id="129_b" value="b">
                  <label for="129_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;Total reliance on linked third parties</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="129[]" id="129_c" value="c">
                  <label for="129_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;Majority of manufacture is in-house</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="129[]" id="129_d" value="d">
                  <label for="129_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;All of the above</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">5</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="130">
              <div class="question">Improvements in the value chain can be implemented by following Kjellsdotter and Jonssons iterative planning cycle. Which of the following does not form part of the cycle?</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="130[]" id="130_a" value="a">
                  <label for="130_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;Creating a quality control plan</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="130[]" id="130_b" value="b">
                  <label for="130_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;Creating a consensus forecast</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="130[]" id="130_c" value="c">
                  <label for="130_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;Creating a preliminary delivery plan</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="130[]" id="130_d" value="d">
                  <label for="130_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;Creating a preliminary production plan</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">6</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="131">
              <div class="question">In selecting a base for measuring quality costs, which of the following should be considered?</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="131[]" id="131_a" value="a">
                  <label for="131_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;Sensitivity to increases and decreases in production schedule.</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="131[]" id="131_b" value="b">
                  <label for="131_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;Affects by seasonal product sales.</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="131[]" id="131_c" value="c">
                  <label for="131_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;Sensitivity to material price fluctuations.</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="131[]" id="131_d" value="d">
                  <label for="131_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;All of the above.</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">7</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="132">
              <div class="question">Mrs. Jones must pack three items for travelling: clothes, make-up, and medicine. Her suitcase has a capacity of 3 ft3. Each unit of clothes takes 1 ft3. A make up occupies 1/4 ft3 and each medicine takes about ½ ft3. The hiker assigns the priority weights 3,4, and 5 to clothes, make-up, and medicine, which means that medicine are the most valuable of the three items. From experience, the Mrs. Jones must take at least one unit of each item and no more than two make-ups. How many of each item should the Mrs. Jones take?</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="132[]" id="132_a" value="a">
                  <label for="132_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;2 clothes, 2 make up and 1 medicine</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="132[]" id="132_b" value="b">
                  <label for="132_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;1 clothes, 1 make ups and 2 medicines</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="132[]" id="132_c" value="c">
                  <label for="132_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;3 clothes, 3 make ups and 1 medicine</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="132[]" id="132_d" value="d">
                  <label for="132_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;4 clothes, 2 make ups and 1 medicine</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">8</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="133">
              <div class="question">Below is the seven-step procedure to design a unit load by James Apple (1977).
                <br>
                <br>1. Select the unit load type
                <br>2. Determine the farthest practicable destination for the unit load
                <br>3. Establish the unit load size
                <br>4. Determine whether the unit load concept is applicable
                <br>5. Determine how to build the unit load
                <br>6. Determine the unit load configuration
                <br>7. Identify the most remote source of a potential unit load
                <br>
                <br>The arrangement of the seven-steps above is…</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="133[]" id="133_a" value="a">
                  <label for="133_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;a.1-4-2-3-5-7-6</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="133[]" id="133_b" value="b">
                  <label for="133_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;b.4-1-2-7-3-6-5</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="133[]" id="133_c" value="c">
                  <label for="133_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;c.4-1-7-2-3-6-5</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="133[]" id="133_d" value="d">
                  <label for="133_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;d.1-4-2-7-6-5-3</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">9</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="134">
              <div class="question">Mr. Mahfud has a restaurant called “Sumber Makan”, serves, on average, 60 customers per night. A typical night at “Sumber Makan” is long, about 10 hours. At any point in time, there are, on average, 18 customers in the restaurant. These customers are either enjoying their food and beverages, waiting to order the food, or waiting for their order to arrive. What is the average time customer are in the restaurant?</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="134[]" id="134_a" value="a">
                  <label for="134_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;1.5 hours</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="134[]" id="134_b" value="b">
                  <label for="134_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;2 hours</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="134[]" id="134_c" value="c">
                  <label for="134_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;3 hours</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="134[]" id="134_d" value="d">
                  <label for="134_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;1 hour</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">10</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="135">
              <div class="question">George Flexner, a junior software programmer who writes software for multiple products. He is paid $20 per hour for straight-time and $30 per hour (time and a half) for overtime. His overtime premium is $10 per overtime hour. If he works 44 hours, including 4 overtime hours, in one week his gross compensation would be…</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="135[]" id="135_a" value="a">
                  <label for="135_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;$1000</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="135[]" id="135_b" value="b">
                  <label for="135_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;$840</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="135[]" id="135_c" value="c">
                  <label for="135_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;$920</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="135[]" id="135_d" value="d">
                  <label for="135_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;$800</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">11</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="136">
              <div class="question">Openness to new ideas and experiences is one of the global mind-set that is called….</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="136[]" id="136_a" value="a">
                  <label for="136_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;Intellectual capital</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="136[]" id="136_b" value="b">
                  <label for="136_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;Psychological capital</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="136[]" id="136_c" value="c">
                  <label for="136_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;Social capital</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="136[]" id="136_d" value="d">
                  <label for="136_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;Environment capital</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">12</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="137">
              <div class="question">Create or defend a strong position in a particular segment is one of the alternative strategies in declining industries, called…</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="137[]" id="137_a" value="a">
                  <label for="137_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;Niche</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="137[]" id="137_b" value="b">
                  <label for="137_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;Leadership</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="137[]" id="137_c" value="c">
                  <label for="137_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;Harvest</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="137[]" id="137_d" value="d">
                  <label for="137_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;Divest</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">13</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="138">
              <div class="question">In a golf club shafts factory, it is known that the tensile strength of the steel alloy is normally distributed with standard deviation of 60 psi. An employee randomly selects 12 specimens as a sample with mean of 3250 psi, to be tested whether the mean strength is 3500 psi. The value of the test statistic is…., and the null hypothesis is….</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="138[]" id="138_a" value="a">
                  <label for="138_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;-14.43, accepted</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="138[]" id="138_b" value="b">
                  <label for="138_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;14.43, rejected </label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="138[]" id="138_c" value="c">
                  <label for="138_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;-14.43, rejected</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="138[]" id="138_d" value="d">
                  <label for="138_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;-14.34, rejected</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">14</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="139">
              <div class="question">A student is studying the combination of usage frequency (A), charging frequency (B), and the amount of software installed (C) on the lifetime of a laptop. He chose two levels of each factor and runs two replicates. The data are as follows: The value of the sum of squares error is.….
                <div class="text-center"><img src="../img/question/paket3/3_medium_14.png" alt="table"></div>
              </div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="139[]" id="139_a" value="a">
                  <label for="139_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;20592</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="139[]" id="139_b" value="b">
                  <label for="139_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;24530</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="139[]" id="139_c" value="c">
                  <label for="139_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;28392</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="139[]" id="139_d" value="d">
                  <label for="139_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;27260</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
          <div class="question-list-item">
            <div>
              <h3><b><span class="text-blue">Question no. </span><div class="question-number-circle bg-red text-center" style="position: relative;top: -4px;"><span class="v-align-sub text-white">15</span></div>&nbsp;&nbsp;&nbsp;<span class="text-capitalize"></span></b></h3>
              <input type="hidden" name="question_id" value="140">
              <div class="question">A box A contains 4 red and 5 blue chips and box B contains 6 red and 3 blue chips. A chip is chosen at random from the box A and placed in box Finally, a chip is chosen at random from among those now in box What is the probability a blue chip was transferred from box A to box B given that the chip chosen from box B is red?</div>
              <br>
              <ol type="A" style="list-style:none">
                <li>
                  <input type="checkbox" name="140[]" id="140_a" value="a">
                  <label for="140_a">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">A</span></div>&nbsp;1/3</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="140[]" id="140_b" value="b">
                  <label for="140_b">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">B</span></div>&nbsp;15/29</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="140[]" id="140_c" value="c">
                  <label for="140_c">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">C</span></div>&nbsp;14/45</label>
                  <br>
                </li>
                <li>
                  <input type="checkbox" name="140[]" id="140_d" value="d">
                  <label for="140_d">
                    <div class="choice-circle text-white text-center bg-grey"><span class="v-align-middle">D</span></div>&nbsp;29/45</label>
                  <br>
                </li>
              </ol>
            </div>
          </div>
          <hr>
        </div>
        <input type="hidden" name="paket_id" value="3">
        <input type="hidden" name="user_id" value="1">
      </div>
    </div>

  </div>

  <!-- <nav class="navbar navbar-default navbar-fixed-bottom text-white">
      <div class="container-fluid">
          <div class="row">
              <div class="col-md-10 col-md-offset-1">
                  <div class="pull-left">
                      <span>Total session duration: </span>
                      <div id="session-timer" style="display:inline-block; font-weight:bold; font-size:16px"></div>
                      <span>. System will automatically submit your answer when your session ended.</span>
                  </div>
              </div>
          </div>
      </div>
  </nav> -->
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
          <h4 class="modal-title" id="myModalLabel">Are you serious to submit ?</h4>
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