<p class="border-panel-title-wrap">
    <span class="panel-title-text">Links</span>
</p>
<div class="row">
    <div class="col-md-12 clearfix">
        @foreach(Session::get('link') as $aero_link)
        <a href="http://{{ $aero_link->url}}"
           class="btn btn-lg {{$aero_link->color}}"
           style="margin:5px 1px"
           data-toggle="tooltip"
           data-placement="top"
           title="{{$aero_link->detail_url}}
                   ({{$aero_link->url}})
                   ({{$aero_link->status}})"
           target="_blank"
        >

            {{$aero_link->name}}
        </a>
        @endforeach

    </div>
</div>
