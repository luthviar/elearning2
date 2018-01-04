@extends('user.layouts.app')

@section('content')

<div class="row" style="padding-top: 100px;">
  <div class="container">

    
      @php
        function prints($print_data , $indent) {
              if ( count ($print_data['children']) > 0) {
                echo "<div class='col-xs-". (12- $indent)." col-md-". (12- $indent)." col-md-offset-".$indent." col-xs-offset-".$indent." '>
                          <div class='panel panel-success'>
                            <div class='panel-body' style='background-color: #13B795 !important; color: white;'>
                              <span class='pull-left'>
                                <strong>Modul Training Parent</strong>
                              </span>
                              <span class='pull-right'>
                                <i class='glyphicon glyphicon-chevron-down'></i>
                              </span>
                            </div>
                          </div>
                        </div>";
                foreach ( $print_data['children'] as $children) {
                  prints($children, $indent+1);
                }
              } else {
                echo "<div class='col-xs-". (12- $indent)." col-md-". (12- $indent)." col-md-offset-".$indent." col-xs-offset-".$indent." '>
                          <div class='panel panel-default'>
                            <div class='panel-body'>
                              <span class='pull-left'>
                                <strong>Modul Training Parent</strong>
                              </span>
                              <span class='pull-right' style='color: red;'>
                                <a href='".url('/get_training/2')."' class='btn btn-danger' >Request Access</a> <i  class='glyphicon glyphicon-remove'></i>
                              </span>
                            </div>
                          </div>
                        </div>";
              }

          }
          prints( $trainings , 0);
      @endphp

   
<!--
    <div class="col-xs-11 col-md-11 col-md-offset-1 col-xs-offset-1">
      <div class="panel panel-default">
        <div class="panel-body">
          <span class="pull-left">
            <strong>Modul Training Children</strong>
          </span>
          <span class="pull-right" style="color: green;">
            You can acces this training <i  class="glyphicon glyphicon-ok"></i>
          </span>
        </div>
      </div>
    </div>
    <div class="col-xs-11 col-md-11 col-md-offset-1 col-xs-offset-1">
      <div class="panel panel-default">
        <div class="panel-body">
          <span class="pull-left">
            <strong>Modul Training Children 2</strong>
          </span>
          <span class="pull-right" style="color: red;">
              <a href="#" class="btn btn-danger" >Request Access</a> <i  class="glyphicon glyphicon-remove"></i>
          </span>
        </div>
      </div>
    </div> -->
  </div>
</div>

@endsection