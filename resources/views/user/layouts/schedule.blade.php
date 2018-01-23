<div class="block-title2" style="background-color:transparent !important; border-bottom:none !important; border-top:none !important; padding-top:0px !important;">
    <div style="font-size:28px; font-weight:300; text-align:center;">RECENT TRAINING SCHEDULE</div>
    <div class="title-icon2"><i class="fa fa-calendar fa-2x" style="color:#415FC3; margin-top:10px;;"></i></div>
</div>
<div class="col-md-12">
    <div style="width:80%; margin:0 auto;">
        <div class="list-group" style="position:relative;">
         <?php $n = 0?>
             @if(empty(Session::get('schedule')) == false)
          @foreach(Session::get('schedule') as $sched)
           <?php $n++; ?>
            <a href="{{ url(action('TrainingController@get_trainings',$sched->id)) }}" target="_blank" class="list-group-item">
                <h4 class="list-group-item-heading">
                    {{$sched->modul_name}}
                </h4>
                <p class="list-group-item-text">
                    <strong>Start at:</strong> {{date('j M Y',strtotime($sched->date))}}
                    -
                    {{date('H:i',strtotime($sched->time))}}
                </p>
                <div style="position: absolute; top:0; right:0;">
                <div style="margin:0; color:#FFF; padding:3px 7px; font-size:12px; background-color:#fcb322; font-weight:bold;">{{$n}}</div>
            </div>
            </a>
            
          @endforeach
            @else
                 <h4 class="text-center">You Should Login First</h4>
                 @endif
        </div>
    </div>
</div>

<!--
<p class="border-panel-title-wrap">
    <span class="panel-title-text">Recent Training Schedule</span>
</p>
<div class="row">
    <div class="col-md-12 clearfix">
        <div class="list-group">
        @if(empty(Session::get('schedule')) == false)
          @foreach(Session::get('schedule') as $sched)
            <a href="{{ url(action('TrainingController@get_trainings',$sched->id)) }}" target="_blank" class="list-group-item">
                <h4 class="list-group-item-heading">
                    {{$sched->modul_name}}
                </h4>
                <p class="list-group-item-text">
                    <strong>Start at:</strong> {{date('j M Y',strtotime($sched->date))}}
                    -
                    {{date('H:i',strtotime($sched->time))}}
                </p>
            </a>
          @endforeach
        @endif
        </div>

    </div>
</div>
-->
