@extends('layout')

@section('content')

<div class="row" style="padding-top: 20px;">
  <div class="container">
    <!-- TEST TIME -->
    <div class="col-xs-12 col-md-3">
      <div class="panel panel-default">
        <div class="panel-heading"><strong>Test Time</strong></div>
        <div class="panel-body text-center">
          <h3><strong class="green_color">20 minutes</strong></h3>
        </div>
      </div>
    </div>
    <!-- TEST Question -->
    <div class="col-xs-12 col-md-9">
      <h4><strong class="green_color">Answer all question below.</strong></h4>
      <ul>
        <li style="list-style-type: none;">1. Pertanyaan ini adalah pertanyaan pertama .
          <ul>
            <li style="list-style-type: none;"><input type="radio" onclick="count_answer(1)" name="question1" value="a"> jawab aku donk</li>
            <li style="list-style-type: none;"><input type="radio" onclick="count_answer(1)" name="question1" value="b"> jawab aku aja</li>
            <li style="list-style-type: none;"><input type="radio" onclick="count_answer(1)" name="question1" value="c"> jadi pilih aku apa dia</li>
          </ul>
        </li>
        <li style="list-style-type: none;">2. Pertanyaan ini adalah pertanyaan pertama .
          <ul>
            <li style="list-style-type: none;"><input type="radio" onclick="count_answer(2)" name="question2" value="a"> jawab aku donk</li>
            <li style="list-style-type: none;"><input type="radio" onclick="count_answer(2)" name="question2" value="b"> jawab aku aja</li>
            <li style="list-style-type: none;"><input type="radio" onclick="count_answer(2)" name="question2" value="c"> jadi pilih aku apa dia</li>
          </ul>
        </li>
        <li style="list-style-type: none;">3. Pertanyaan ini adalah pertanyaan pertama .
          <ul>
            <li style="list-style-type: none;"><input type="radio" onclick="count_answer(3)" name="question3" value="a"> jawab aku donk</li>
            <li style="list-style-type: none;"><input type="radio" onclick="count_answer(3)" name="question3" value="b"> jawab aku aja</li>
            <li style="list-style-type: none;"><input type="radio" onclick="count_answer(3)" name="question3" value="c"> jadi pilih aku apa dia</li>
          </ul>
        </li>
      </ul>
      <div class="text-center">
        <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#myModal">
          Finish
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Are you serious to submit ?</h4>
      </div>
      <div class="modal-body text-center">
        <h5>Total Question : 3</h5>
        <h5 id="total_answered">Total Answered : </h5>
        <h5>Total Empty Answer : 0</h5>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  var answered = new Array();
  var in_answered = false;
  function count_answer( name ) {
    for (var i = answered.length - 1; i >= 0; i--) {
      if ( answered[i] == name) {
        in_answered = true;
      }
    }
    if (!in_answered) {
      answered.push(name);
    }
    if (in_answered) {
      in_answered = false;
    }
    var total_answered = document.getElementById('total_answered');
    total_answered.innerHTML= 'Total Answered : '+answered.length;
  }
  
</script>

@endsection