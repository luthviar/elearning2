@extends('admin.layouts.app')

@section('page-name')
    All Links of Aerofood System
    <i class="fa fa-info-circle"
       data-toggle="tooltip"
       data-placement="top"
       title="Links ini akan ditampilkan di halaman user"
    ></i>
@endsection

@section('content')

    <!-- Main content -->
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">List of Links</h3>
                @if(Session::get('success') != null)
                    <hr/>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h4><i class="icon fa fa-check"></i> Berhasil!</h4>

                        {{ Session::get('success') }}


                    </div>
                @endif
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="example2" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Deskripsi</th>
                        <th>URL</th>
                        <th>Status Progress</th>
                        <th>Color</th>
                    </tr>
                    </thead>

                    <tbody>

                    @foreach($links as $aero_link)
                        <tr>

                            <td>
                                <a href="{{ url(action('AerofoodLinksController@view',$aero_link->id)) }}">
                                    {{$aero_link->name}}
                                </a>
                            </td>
                            <td>{{$aero_link->detail_url}} </td>
                            <td>{{$aero_link->url}}</td>
                            <td>{{ $aero_link->status }}</td>
                            <td>{{ $aero_link->color }}</td>
                        </tr>
                    @endforeach

                    </tbody>

                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#example2').DataTable();
        });
    </script>
@endsection