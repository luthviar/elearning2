<p class="border-panel-title-wrap">
    <span class="panel-title-text">Schedule</span>
</p>
<div class="row">
    <div class="col-md-12 clearfix">
        <ul>
          @foreach($schedule as $sched)
            <li>- {{$sched->modul_name}} . {{date('j M Y',strtotime($sched->date))}} . {{date('H:i',strtotime($sched->time))}}</li>
          @endforeach
        </ul>
    </div>
</div>
