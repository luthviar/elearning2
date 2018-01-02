@extends('layout')

@section('content')

  <div class="row" style="padding-top: 20px;">
    <div class="container">
      <!-- Nav tabs -->
      <ul class="nav nav-tabs" role="tablist">
        <li role="presentation" class="active">
          <a href="{{url('/get_forum/public')}}">Public Forum</a>
        </li>
        <li role="presentation">
          <a href="{{url('/get_forum/job_family')}}">Job Family Forum</a>
        </li>
        <li role="department">
          <a href="{{url('/get_forum/department')}}">Department Forum</a>
        </li>
      </ul>

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="public">
          <div class="text-center">
            <h3><strong class="green_color">Public Forum</strong></h3>
            <h5>Forum for All Aerofood employee  </h5>
          </div>
          <table class="table table-striped">
            <thead>
              <tr>
                <td><strong>Title</strong></td>
                <td><strong>Created by</strong></td>
                <td><strong>Comments</strong></td>
                <td><strong>Last seen</strong></td>
              </tr>
            </thead>
            <tbody>
              @if (!$forums instanceof Traversable)
                <tr>{{ $forums }}</tr>
              @else
                @foreach ( $forums as $forum)
                  <tr>
                    <td>{{ $forum->title}}</td>
                    <td>{{ $forum['user']->name}} <br> {{ $forum->created_at}}</td>
                    <td>{{ $forum['comments_count'] }}</td>
                    @if ( $forum['comments_count'] == 0)
                    <td>{{ $forum['last_seen']}} </td>
                    @else
                    <td>{{ $forum['last_seen']['user']->name}} <br> {{ $forum['last_seen']['created_at'] }}</td>
                    @endif
                  </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
        <div class="text-right">
          {{ $forums->links() }}
        </div>
      </div>
    </div>
  </div>
@endsection