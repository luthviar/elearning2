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
use Session;

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
        if ( $user_chapter_record->is_user_has_record(\Auth::user()->id,$id_training) == 'no') {
            $initiate = $user_chapter_record->add_user_chapter_record_initiate(\Auth::user()->id, $id_training);
            if ($initiate != 'selesai') {
                return view('user.error')->with('error', $initiate);
            }
        }
        $count_finish_chapter = $user_chapter_record->check_finish_chapter( \Auth::user()->id, $id_training);

        Session::put('training', $trainings);
        Session::put('finish_chapter', $count_finish_chapter);

        $trainings2 = Session::get('training');
        $finish_chapter2 = Session::get('finish_chapter');

        return view('user.training.intro_training')->with('training', $trainings2)->with('module', $modul)->with('finish_chapter', $finish_chapter2);
    	

    }

    public function get_material( $id_chapter ) {
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

//        $trainings = Session::get('trainings');

        $material = new Material();
        $material_training = $material->get_material ( $id_chapter);


        if ( $material_training['status'] == 'error') {
            return view('user.error')->with('error', $material_training)->with('module', $modul);
        }
        $chapter = new Chapter();
        $chapter = $chapter->get_chapter($material_training->id_chapter);
        if ($chapter['status'] == 'error') {
            return view('user.error')->with('error', $chapter)->with('module', $modul);
        }
        $chapter['material'] = $material_training;
        return view('user.training.material')->with('chapter', $chapter)->with('module', $modul);
    }

    public function finish_chapter( $id_chapter ) {
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        $records = new UserChapterRecord();
        $record = $records->record_chapter( \Auth::user()->id, $id_chapter);
        if ($record['status'] == "error") {
            return view('user.error')->with('error', $record)->with('module', $modul);
        }
        $chapter = new Chapter();
        $next_chapter = $chapter->next_chapter( $id_chapter );
        if ($next_chapter['status'] == 'error') {
            return view('user.error')->with('error', $next_chapter)->with('module', $modul);
        }
        if ($next_chapter['chapter'] == null) {
            return redirect('get_training/'.$record->id_module_training);
        }
        if ($next_chapter['chapter']->category == 0) {
            return redirect('/material/'.$next_chapter['chapter']->id);
        } else {
            return redirect('/test/'.$next_chapter['chapter']->id);
        }
        
        
    }

    public function get_test ( $id_chapter ) {
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        $test = new Test();
        $test = $test->get_test($id_chapter);

        if ($test['status'] == 'error') {
            return view('user.error')->with('error', $test)->with('module', $modul);
        }
        $chapter = new Chapter();
        $chapter = $chapter->get_chapter($test->id_chapter);
        if ($chapter['status'] == 'error') {
            return view('user.error')->with('error', $chapter)->with('module', $modul);
        }
        // check test record 
        $user_test_record = new UserTestRecord();
        $record = $user_test_record->is_user_record_exist( \Auth::user()->id, $test->id);

        if ( $record == 'yes') {
            // return review test page
            return redirect('review_test/'.$id_chapter);
        }
        // initiate test record
        $user_test_record = $user_test_record->initiate_user_test_record(\Auth::user()->id,$test);
        if ($user_test_record['status'] == 'error') {
            return view('user.error')->with('error', $user_test_record)->with('module', $modul);
        }

        // update finish record 
        $record_chapter = new UserChapterRecord();
        $record_chapter = $record_chapter->record_chapter( \Auth::user()->id, $id_chapter);
        if ($record_chapter['status'] == "error") {
            return view('user.error')->with('error', $record_chapter)->with('module', $modul);
        }

        $chapter['test'] = $test;
        $char = 'A';

        $record_session = Session::put('record',$record);

        dd(Session::get('record'));
        // start test of training
        return view('user.training.online_test')
            ->with('chapter', $chapter)->with('test',$test)->with('module',$modul)->with('char',$char)->with('record',$record_session);

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
            $record = $record->submit_answer(\Auth::user()->id, $question->id, $option);
            if ($record['message'] == 'error') {
                return view('user.error')->with('error', $record)->with('module', $modul);
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
        $user_record = $user_record->review_test(\Auth::user()->id, $test->id);
        if ($user_record['status'] == 'error') {
            return view('user.error')->with('error', $user_record)->with('module', $modul);
        }
        

        return view('user.training.online_test_review')->with('chapter', $chapter)->with('record', $user_record)->with('module', $modul);
    }

    public function next_chapter($id_chapter){
        $chapter = new Chapter();
        $next_chapter = $chapter->next_chapter( $id_chapter );
        if ($next_chapter['status'] == 'error') {
            return view('user.error')->with('error', $next_chapter);
        }
        if ($next_chapter['chapter'] == null) {
            $this_chapter = Chapter::find($id_chapter);
            return redirect('get_training/'.$this_chapter->id_module);
        }
        if ($next_chapter['chapter']->category == 0) {
            return redirect('/material/'.$next_chapter['chapter']->id);
        } else {
            return redirect('/test/'.$next_chapter['chapter']->id);
        }
    }

}
