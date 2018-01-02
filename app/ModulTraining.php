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

    	
    	function getTraining($super_module){

    		// mendapatkan material pada chapter
    		function getMaterial ( $chapter ) {

	    		function getFileMaterial ( $material ) {
	    			$file_materials = FilesMaterial::where( "id_material" , $material->id )->get();
	    			if ( $file_materials == null ) {
	    				return "";
	    			} else {
	    				return $file_materials;
	    			}
	    		}

	    		$material = Material::where( "id_chapter" , $chapter->id )->first();
				$material["files_material"] = getFileMaterial( $material );

				return $material;
	    	}

	    	// mendapatkan test pada chapter
	    	function getTest ( $chapter ) {
	    		
	    		function get_question_option( $question ) {
	    			$options = QuestionOption::where( 'id_question' , $question->id )->get();
	    			if ( count($options) == 0) {
	    				return "tidak ada opsi";
	    			} else {
	    				return $options;
	    			}
	    		}

	    		$test = Test::where( 'id_chapter' , $chapter->id )->first();
	    		$questions = Question::where( 'id_test' , $test->id )->get();
	    		if ( count($questions) == 0 ) {
	    			$test['questions'] = " tidak ada pertanyaan";
	    		} else {
	    			foreach ($questions as $question) {
		    			$question['option'] = get_question_option( $question );
		    		}	
		    		$test['questions'] = $questions;
	    		}
	    		
	    		return $test;
	    	}


	    	// --------------MAIN-------------------

    		$chapters = Chapter::where( 'id_module' , $super_module->id )->orderBy( "sequence" , "asc" )->get();
    		if ( count($chapters) == 0 ) {
    			return "belum ada chapter";
    		} else {
    			foreach ( $chapters as $chapter ) {
    				//check apakah chapter berupa konten atau test
    				if ($chapter->category == 0) {
    					// materials
    					$chapter['material'] = getMaterial ( $chapter );
    				} else {
    					// test
    					$chapter['test'] = getTest ( $chapter );
    				}
    			}
    		}
    		return $chapters;

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
    	$modules 	= ModulTraining::where('id_parent',$module_id)->get();

    	// apabila tidak mempunyai anak, maka masuk dalam kategori training
    	// jika mempunyai anak, maka dia masuk dalam parent training (modul)
    	if (count($modules) != 0){
    		$output = getModule( $super_module , $modules );
            $output['status'] = "parent";

    		return $output;
    	}else{
    		$super_module['chapter'] = getTraining($super_module);
            $super_module['status'] ="children";

    		return $super_module;
    	}
    	
    }

    
}
