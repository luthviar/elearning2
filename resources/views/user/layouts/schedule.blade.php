<p class="border-panel-title-wrap">
    <span class="panel-title-text">Recent Training Schedule</span>
</p>
<div class="row">
    <div class="col-md-12 clearfix">
        <div class="list-group">
          @foreach(Session::get('schedule') as $sched)
            <a href="{{ url(action('TrainingController@get_trainings',$sched->id)) }}" class="list-group-item">
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
        </div>

    </div>
</div>
