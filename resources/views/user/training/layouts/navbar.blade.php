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
                    <a href="{{ url('/material', $chapter->id) }}" class="icon">
                      <span>
                          <i class="glyphicon glyphicon-book"></i>
                          {{$chapter->chapter_name}}
                      </span>
                    </a>
                </li>

            @else

                @if(Request::is('review_test/*'))
                <li class="{{ Request::is('review_test/*') ? 'tab-current' : '' }}">
                @else
                <li class="{{ Request::is('test/*') ? 'tab-current' : '' }}">
                @endif

                    <a
                        {{--onclick="window.open('{{ url('/test', $chapter->id) }}','popup','width=1366,height=669');"--}}
                        href="{{ url('/test', $chapter->id) }}"
                        class="icon"
                        style="margin-right: 0px; cursor: pointer;"
                    >
                      <span>
                          <i class="glyphicon glyphicon-pencil"></i>
                          {{$chapter->chapter_name}}
                      </span>
                    </a>
                </li>


            @endif

        @else
            <li class="{{ Request::is('test/*') ? 'tab-current' : '' }}">
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