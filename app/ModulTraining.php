<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Chapter;
use App\Material;
use App\FilesMaterial;
use App\Test;
use App\Question;
use App\QuestionOption;

class ModulTraining extends Model
{
    
    protected $table="modul_trainings";

    // fungsi mendapatkan modul dasar (super modul)
    public function get_module_training(){

    	$modul_trainings = ModulTraining::where("id_parent",0)->get();
    	return $modul_trainings;

    }

    // fungsi mendapatkan modul atau training pada suatu modul
    public function get_trainings( $module_id ) {

    	

    	function getModule ( $super_module , $modules ) {

    		function getChildren ( $module ) {
	    		$children = ModulTraining::where('id_parent', $module->id)->get();
	    		foreach ($children as $child ) {
	    			$child['children'] = getChildren($child);
	    		}

	    		return $children;
	    	}

	    	// --------------------------------------

    		foreach ($modules as $module ) {
	    		$module['children'] = getChildren( $module );
	    	}
	    	$super_module['children'] = $modules;

	    	return $super_module;
    	}

    	// ------------------------------------------------
    	//				Main
    	// ------------------------------------------------

    	// mengambil modul dari id_module yang diberikan
    	$super_module = ModulTraining::find($module_id);
    	if ($super_module == null) {
    		return "module not found";
    	}

    	// mengambil anak dari modul yang bersangkutan
    	$modules 	= ModulTraining::where('id_parent',$module_id)->where('is_publish',1)->get();

    	// apabila tidak mempunyai anak, maka masuk dalam kategori training
    	// jika mempunyai anak, maka dia masuk dalam parent training (modul)
    	if ($super_module->is_child == 0){
    		$output = getModule( $super_module , $modules );
            $output['status'] = "parent";

    		return $output;
    	}else{
			$chapters = Chapter::where( 'id_module' , $super_module->id )->orderBy( "sequence" , "asc" )->get();
    		if ( count($chapters) == 0 ) {
    			return "belum ada chapter";
    		} 
    		$super_module['chapter'] = $chapters;
            $super_module['status'] ="children";

    		return $super_module;
    	}
    	
    }

    
}
