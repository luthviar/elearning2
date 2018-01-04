<ul>
    <li class="tab-current">
        <a href="#" class="icon">
              <span>
                  <i class="glyphicon glyphicon-th-list"></i>
                   List of Chapters
              </span>
        </a>
    </li>


    @foreach ( Session::get('training')['chapter'] as $key => $chapter)
        @if ($key < Session::get('finish_chapter'))

            @if ($chapter->category == 0)
                <li class="">
                    <a href="{{ url('/material', $chapter->id) }}" class="icon">
                      <span>
                          <i class="glyphicon glyphicon-book"></i>
                          {{$chapter->chapter_name}}
                      </span>
                    </a>
                </li>

            @else
                <li>
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
            <li>
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