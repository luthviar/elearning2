<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Raport extends Model
{
    
    public function get_raport_all_user () {

    }

    public function get_raport_one_user ( $id_user ) {
    	$raport = Raport::where('id_user', $id_user)->get();
    	if ( count($raport) == 0) {
    		return "no raport found";
    	}
    	return $raport;
    }

    public function get_last_user_raport ( $id_user ) {
    	$raport = Raport::where( 'id_user', $id_user)->orderBy('created_at','desc')->first();
    	if ( $raport == null) {
    		return "no raport found";
    	}
    	return $raport;
    }
}
