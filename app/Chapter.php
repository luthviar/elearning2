<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    
    public function get_chapter ( $id_chapter) {
    	$chapter = Chapter::find( $id_chapter );
    	if ( $chapter == null) {
    		$chapter['status'] = 'error';
    		$chapter['message'] ='no chapter found';
    	}
    	$chapter['status'] = 'success';
    	return $chapter;
    }

    
}
