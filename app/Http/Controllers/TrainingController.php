<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModulTraining;

class TrainingController extends Controller
{
    
    public function get_module_training(){
    	$modul = new ModulTraining();
    	$modul_trainings = $modul->get_module_training();
    	if ($modul_trainings == null) {
    		# code...
    	}else{
    		foreach ($modul_trainings as $modul_training ) {
    			echo $modul_training->modul_name . "<br>";
    		}
    	}
    }

    public function get_trainings( $id_training ){

              
    	$modul = new ModulTraining();
    	$trainings = $modul->get_trainings( $id_training );

        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();



        if ( $trainings['status'] == "parent") {
            return view('module_training')->with( 'trainings', $trainings)->with('module', $modul);
        } else {
            return "";
        }
    	

    }

}
