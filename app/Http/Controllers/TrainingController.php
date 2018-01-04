<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModulTraining;
use App\Auth;
use App\UserChapterRecord;
use App\Material;
use App\Chapter;
use App\Test;
use App\UserTestRecord;

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
            return view('user.training.module_training')->with( 'trainings', $trainings)->with('module', $modul);
        } 

        $user_chapter_record = new UserChapterRecord();
        if ( $user_chapter_record->is_user_has_record(1,$id_training) == 'no') {
            $initiate = $user_chapter_record->add_user_chapter_record_initiate(1, $id_training);
            if ($initiate != 'selesai') {
                return view('user.training.error')->with('error', $initiate);
            }
        }
        $count_finish_chapter = $user_chapter_record->check_finish_chapter( 1, $id_training);
        
        return view('user.training.intro_training')->with('training', $trainings)->with('module', $modul)->with('finish_chapter', $count_finish_chapter);
    	

    }

    public function get_material( $id_chapter ) {
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        $material = new Material();
        $material_training = $material->get_material ( $id_chapter);


        if ( $material_training['status'] == 'error') {
            return view('user.training.error')->with('error', $material_training)->with('module', $modul);
        }
        $chapter = new Chapter();
        $chapter = $chapter->get_chapter($material_training->id_chapter);
        if ($chapter['status'] == 'error') {
            return view('user.training.error')->with('error', $chapter)->with('module', $modul);
        }
        $chapter['material'] = $material_training;
        return view('user.training.material')->with('chapter', $chapter)->with('module', $modul);
    }

    public function finish_chapter( $id_chapter ) {
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        $record = new UserChapterRecord();
        $record = $record->record_chapter( 1, $id_chapter);
        if ($record['status'] == "error") {
            return view('user.training.error')->with('error', $record)->with('module', $modul);
        }
        return redirect('get_training/'.$record->id_module_training);
    }

    public function get_test ( $id_chapter ) {
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        $test = new Test();
        $test = $test->get_test($id_chapter);

        if ($test['status'] == 'error') {
            return view('user.training.error')->with('error', $test)->with('module', $modul);
        }
        $chapter = new Chapter();
        $chapter = $chapter->get_chapter($test->id_chapter);
        if ($chapter['status'] == 'error') {
            return view('user.training.error')->with('error', $chapter)->with('module', $modul);
        }
        // check test record 
        $user_test_record = new UserTestRecord();
        $record = $user_test_record->is_user_record_exist(1, $test->id);
        if ( $record == 'yes') {
            // return review test page
            return redirect('review_test/'.$id_chapter);
        }
        // initiate test record
        $user_test_record = $user_test_record->initiate_user_test_record(1,$test);
        if ($user_test_record['status'] == 'error') {
            return view('user.training.error')->with('error', $user_test_record)->with('module', $modul);
        }

        // update finish record 
        $record_chapter = new UserChapterRecord();
        $record_chapter = $record_chapter->record_chapter( 1, $id_chapter);
        if ($record_chapter['status'] == "error") {
            return view('user.training.error')->with('error', $record_chapter)->with('module', $modul);
        }

        $chapter['test'] = $test;

        // start test of training
        return view('user.training.online_test')->with('chapter', $chapter)->with('test',$test)->with('module',$modul);

    }

    public function submit_test ( Request $request) {
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();


        $id_chapter = $request->id_chapter;
        $test = new Test();
        $test = $test->get_test($id_chapter);
        
        
        foreach ($test['questions'] as  $question) {
            
            $id_question = $question->id;
            $option = $request->$id_question;

            $record = new UserTestRecord();
            $record = $record->submit_answer(1, $question->id, $option);
            if ($record['message'] == 'error') {
                return view('user.training.error')->with('error', $record)->with('module', $modul);
            }
            
            
        }
        return redirect('review_test/'.$id_chapter);
        
    }

    public function review_test( $id_chapter) {
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        $chapter = new Chapter();
        $chapter = $chapter->get_chapter($id_chapter);

        $test = Test::where('id_chapter', $id_chapter)->first();

        $user_record = new UserTestRecord();
        $user_record = $user_record->review_test(1, $test->id);
        if ($user_record['status'] == 'error') {
            return view('user.training.error')->with('error', $user_record)->with('module', $modul);
        }
        

        return view('user.training.online_test_review')->with('chapter', $chapter)->with('record', $user_record)->with('module', $modul);
    }

}
