<ul>
    <li class="{{ Request::is('get_training/*') ? 'tab-current' : '' }}">
        <a
            href="{{ url('get_training/'.Session::get('child_id')) }}"
            class="icon">
              <span>
                  <i class="glyphicon glyphicon-th-list"></i>
                   List of Chapters
              </span>
        </a>
    </li>


    @foreach ( Session::get('training')['chapter'] as $key => $chapter)
        @if ($key < Session::get('finish_chapter'))

            @if ($chapter->category == 0)
                <li class="{{ Request::is('material/*') ? 'tab-current' : '' }}">
                    <a
                        {{--href="{{ url('/material', $chapter->id) }}"--}}
                        onclick="window.open('{{ url('/material',$chapter->id) }}','_self')"
                        style="cursor:pointer;"
                        class="icon">
                      <span>
                          <i class="glyphicon glyphicon-book"></i>
                          {{$chapter->chapter_name}}
                      </span>
                    </a>
                </li>

            @else

                @if(Request::is('review_test/*'))
                <li class="{{ Request::is('review_test/'.$chapter->id) ? 'tab-current' : '' }}">
                @else
                <li class="{{ Request::is('test/'.$chapter->id) ? 'tab-current' : '' }}">
                @endif
                    @if(Session::get('record') == 'yes')
                    <a
                        onclick="window.open('{{ url('/test',$chapter->id) }}','_self')"
                        target="_self"
                        class="icon"
                        style="margin-right: 0px; cursor: pointer;"
                    >
                        {{--belum pernah test masuk tidak yes--}}
                        @elseif(Session::get('record') != 'yes')
                    <a
                        onclick="window.open('{{ url('/test',$chapter->id) }}','_self')"
                        target="_self"
                        class="icon"
                        style="margin-right: 0px; cursor: pointer;"
                        data-toggle="modal" data-target="#TestStart"
                    >
                        @endif
                      <span>
                          <i class="glyphicon glyphicon-pencil"></i>
                          {{$chapter->chapter_name}}
                      </span>
                    </a>
                </li>



            @endif

        @else
            <li class="{{ Request::is('test/*') || Request::is('material/*') || Request::is('review_test/*') ? 'tab-current' : '' }}">
                <a href="#" class="icon">
                  <span>
                      <i class="glyphicon glyphicon-pencil"></i>
                      {{$chapter->chapter_name}}
                  </span>
                </a>
            </li>

        @endif
    @endforeach
</ul>