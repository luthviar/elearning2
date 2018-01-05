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

    public function next_chapter ( $id_chapter ) {
        $chapter = Chapter::find($id_chapter);
        if ($chapter == null) {
        	$chapter['status'] = 'error';
        	$chapter['message'] = 'chapter not found';
        	return $chapter;
        }
        $next_chapter = Chapter::where('id_module', $chapter->id_module)->where('sequence',$chapter->sequence +1)->first();
        
        $output['chapter'] = $next_chapter;
    	$output['status'] = 'success';
    	
        return $output;
    }

    
}
