<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ModulTraining;
use App\Auth;
use App\UserChapterRecord;
use App\User;
use App\Material;
use App\Chapter;
use App\Test;
use App\FilesMaterial;
use App\UserTestRecord;
use App\OsDepartment;
use App\Question;
use App\QuestionOption;
use DB;
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
//                dd($initiate);
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
        $record_session = Session::put('record',$record);

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



//        dd(Session::get('record'));
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

    // ----------------------------------
    // ADMIN AREA
    // ----------------------------------

    public function add_training (){
        $parent = ModulTraining::where('is_child',0)->get();
        $department = OsDepartment::all();
        return view('admin.training_add')->with('parent',$parent)->with('department',$department);
    }

    public function add_training_submit (Request $request) {
        $time = substr($request->time, 0,5);
        if (substr($request->time, 6) == 'AM') {
            $time = $time .':00';
        }else{
            $hours = (int) substr($time, 0,2) + 12;
            $time = $hours . substr($request->time, 2,3) . ':00';
        }
        $id;
        if ($request->id_parent == 3) {
            $id = DB::table('modul_trainings')->insertGetId(
                [
                'modul_name'    => $request->modul_name, 
                'id_parent'     => $request->id_parent,
                'description'   => $request->description,
                'date'          => $request->date,
                'time'          => $time,
                'id_department' => $request->id_department,
                'is_active'     => 1,
                'is_publish'    => 0,
                'is_child'      => 1,
                ]
            );
        } else {
            $id = DB::table('modul_trainings')->insertGetId(
                [
                'modul_name'    => $request->modul_name, 
                'id_parent'     => $request->id_parent,
                'description'   => $request->description,
                'date'          => $request->date,
                'time'          => $time,
                'is_active'     => 1,
                'is_publish'    => 0,
                'is_child'      => 1,
                ]
            );
        }

        return redirect('/manage_training/'. $id);
    }

    public function manage_training ($id_training){
        // get parent training
        $parent = ModulTraining::where('is_child',0)->get();

        $training = ModulTraining::find($id_training);
        if ($training == null) {
            return "error";
        }
        $chapter = Chapter::where('id_module',$training->id)->get();
        if (count($chapter) != 0) {
            foreach ($chapter as  $chaps) {
                if ($chaps->category == 0) {
                    $material = new Material();
                    $chaps['material'] = $material->get_material($chaps->id);
                }else{
                    $test = new Test();
                    $chaps['test'] = $test->get_manage_test($chaps->id);
                }
            }
        }
        $training['chapter'] = $chapter;
        return view('admin.training_manage')->with('training',$training)->with('parent',$parent);
    }

    public function add_chapter ($id_module) {
        $modul= ModulTraining::find($id_module);
        if ($modul == null) {
            return "error : module not found";
        }
        return view('admin.training_add_chapter')->with('module',$modul);
    }

    public function add_chapter_submit (Request $request) {
        // get sequence from id_module
        $sequence = Chapter::where('id_module', $request->id_module)->orderBy('sequence','desc')->first();
        $seq = 0;
        if ($sequence != null) {
            $seq = $sequence->sequence + 1;
        }

        $id = DB::table('chapters')->insertGetId(
            [
            'id_module'     => $request->id_module, 
            'chapter_name'  => $request->chapter_name,
            'category'      => $request->category,
            'sequence'      => $seq,
            ]
        );
        if ($request->category == 0) {
            $material = new Material;
            $material->id_chapter = $id;
            $material->description = $request->description;
            $material->save();
        } elseif($request->category == 1){
            $test = new Test;
            $test->id_chapter = $id;
            $test->description = $request->description;
            $test->time = $request->time;
            $test->save();
        }
        
        return redirect('manage_chapter/'.$id);


    }

    public function manage_chapter($id_chapter) {
        $chapter = Chapter::find($id_chapter);
        if ($chapter == null) {
            return "error : chapter not found";
        }
        if ($chapter->category == 0) {
            $material = new Material();
            $chapter['material'] = $material->get_material_admin($id_chapter);
        } else {
            $test = new Test();
            $chapter['test'] = $test->get_manage_test($id_chapter);
        }
        return view('admin.training_manage_chapter')->with('chapter',$chapter);
    }

    public function add_question_submit(Request $request){
        $id = DB::table('questions')->insertGetId(
            [
            'id_test'     => $request->id_test, 
            'question_text'  => $request->question_text
            ]
        );

        $options = $request->option;
        foreach ($options as $key => $value) {
            $option1 = new QuestionOption;
            $option1->id_question = $id;
            $option1->option_text = $value;
            $option1->is_true     = 0;
            $option1->save();
        }
        
        return redirect('select_answer/'. $id);
    }

    public function select_answer ($id_question) {
        $question = Question::find($id_question);
        if ($question == null) {
            return "error: question not found";
        }
        $question['option'] = QuestionOption::where('id_question',$id_question)->get();

        return view('admin.training_select_option_true')->with('question',$question);
    }

    public function select_answer_submit (Request $request) {
        $id_true_answer = $request->true_answer;
        $option = QuestionOption::find($id_true_answer);
        $option->is_true = 1;
        $option->save();

        $question = Question::find($option->id_question);
        $test = Test::find($question->id_test);
        return redirect('manage_chapter/'.$test->id_chapter);
    }

    public function remove_question ($id_question) {
        $question = Question::find($id_question);
        if ($question == null) {
            return "error : question not found";
        }
        $test = Test::find($question->id_test);
        DB::table('question_options')->where('id_question','=',$id_question)->delete();
        DB::table('questions')->where('id','=',$id_question)->delete();

        return redirect('manage_chapter/'.$test->id_chapter);
    }

    public function edit_question($id_question) {
        $question = Question::find($id_question);
        if ($question== null) {
            return "error : question not found";
        }
        $question['option'] = QuestionOption::where('id_question',$id_question)->get();

        return view('admin.training_edit_question')->with('question',$question);
    }

    public function edit_question_submit (Request $request) {
        $question = Question::find($request->question_id);
        if ($question == null) {
            return "error : question not found";
        }
        DB::table('question_options')->where('id_question','=',$question->id)->delete();
        $question->question_text = $request->question_text;
        $question->save();

        $new_option = $request->option;        
        foreach ($new_option as $key => $option) {
            $option1 = new QuestionOption;
            $option1->id_question = $question->id;
            $option1->option_text = $option;
            $option1->is_true     = 0;
            $option1->save();
        }
        

        return redirect('select_answer/'. $question->id);
    }

    public function edit_chapter ( $id_chapter){
        $chapter = Chapter::find($id_chapter);
        if ($chapter== null) {
            return "error : chapter not found";
        }
        if ($chapter->category == 0) {
            $chapter['material'] = Material::where('id_chapter', $id_chapter)->first();
            if ($chapter['material'] == null) {
                return "error: material not found";
            }
        } else {
            $chapter['test'] = Test::where('id_chapter', $id_chapter)->first();
            if ($chapter['test'] == null) {
                return "error: test not found";
            }
        }

        return view('admin.training_edit_chapter_overview')->with('chapter', $chapter);

    }

    public function edit_chapter_submit (Request $request) {
        $chapter = Chapter::find($request->id_chapter);
        if ($chapter == null) {
            return "error : chapter not found";
        }
        $chapter->chapter_name = $request->chapter_name;
        $chapter->category      = $request->category;
        $chapter->save();

        if ($request->category == 0) {
            $material = Material::where('id_chapter', $request->id_chapter)->first();
            if ($material == null) {
                $material = new Material;
                $material->id_chapter = $request->id_chapter;
                $material->description = $request->description;
                $material->save();
            }else{
                $material->description = $request->description;
                $material->save();
            }
        } else {
            $test = Test::where('id_chapter', $request->id_chapter)->first();
            if ($test == null) {
                $test = new Test;
                $test->id_chapter = $request->id_chapter;
                $test->description = $request->description;
                $test->save();
            } else {
                $test->description = $request->description;
                $test->save();
            }
        }

        return redirect('manage_chapter/'. $request->id_chapter);
    }

    public function remove_chapter ($id_chapter){
        $chapter = Chapter::find($id_chapter);
        if ($chapter== null) {
            return "error:chapter not found";
        }
        $id_module = $chapter->id_module;
        DB::table('chapters')->where('id','=',$id_chapter)->delete();

        return redirect('manage_training/'.$id_module);
    }

    public function admin_training () {
        return view('admin.training');
    }

    public function admin_training_serverside( Request $request) {
        $columns = array( 
                            0 =>'modul_name', 
                            1 =>'id_parent',
                            2 => 'description',
                            3 => 'date',
                            4 => 'time',
                            5 => 'is_publish',
                            6 => 'created_at'
                        );
  
        $totalData = ModulTraining::where('is_child', 1)->count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {   
            $ModulTraining = ModulTraining::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->where('is_child',1)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $ModulTraining =  DB::table('modul_trainings')
                            ->where('modul_trainings.is_child','=',1)
                            ->where(function($query) use ($search){
                                $query->where('modul_trainings.modul_name', 'LIKE',"%{$search}%");
                                $query->orWhere('modul_trainings.description','LIKE',"%{$search}%");
                            })
                            ->orderBy($order,$dir)
                            ->limit($limit)
                            ->offset($start)
                            ->get();


            $totalFiltered = DB::table('modul_trainings')
                             ->where('modul_trainings.is_child','=',1)
                             ->where(function($query) use ($search){
                                $query->where('modul_trainings.modul_name', 'LIKE',"%{$search}%");
                                $query->orWhere('modul_trainings.description','LIKE',"%{$search}%");
                             })
                             ->count();
        }

        $data = array();
        if(!empty($ModulTraining))
        {
            foreach ($ModulTraining as $module)
            {

                $nestedData['modul_name'] = "<a href='".url('/manage_training',$module->id)."'>".$module->modul_name."</a>";

                $parent = ModulTraining::find($module->id_parent);
                $nestedData['parent'] = $parent->modul_name;
                $nestedData['snippet'] = substr(strip_tags($module->description),0,50)."...";
                $nestedData['date'] = date('j M Y',strtotime($module->date));
                $nestedData['time'] = $module->time;
                if ($module->is_publish == 1) {
                    $nestedData['is_publish'] = "published";
                } else {
                    $nestedData['is_publish'] = "not published";
                }
                $nestedData['created_at'] = date('j M Y',strtotime($module->created_at));
                
                
                
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
    }

    public function material_add (Request $request){
        $material = Material::find($request->id_material);
        if ($material == null) {
            return "error : material not found";
        }
        $file = $request->file('file');
        $url = null;
        if (!empty($file)) {
            $destinationPath = 'file_attachments';
            $movea = $file->move($destinationPath,$file->getClientOriginalName());
            $url = "ViewerJS/index.html#../file_attachments/{$file->getClientOriginalName()}";
        }

        $attachment = new FilesMaterial;
        $attachment->id_material = $request->id_material;
        $attachment->name = $request->attachment_name;
        $attachment->url = $url;
        $attachment->save();

        return redirect('manage_chapter/'.$material->id_chapter);
    }

    public function remove_material_file($id_file){

        $file = FilesMaterial::find($id_file);
        if ($file == null) {
            return "error : file material not found";
        }
        $material = Material::find($file->id_material);
        DB::table('files_materials')->where('id','=',$id_file)->delete();

        return redirect('manage_chapter/'.$material->id_chapter);
    }

    public function edit_training( $id_training){
        $module = ModulTraining::find($id_training);
        $parent = ModulTraining::where('is_child', 0)->get();
        if ($module == null) {
            return "error: module not found";
        }
        $department = OsDepartment::all();

        return view('admin.training_edit')->with('module', $module)->with('parent',$parent)->with('department',$department);
    }

    public function edit_training_submit(Request $request){
        $module = ModulTraining::find($request->id_module);
        if ($module == null) {
            return "error: module not found";
        }
        $module->modul_name    = $request->modul_name;
        $module->id_parent     = $request->id_parent;
        $module->description  = $request->description;
        if ($request->id_parent == 3) {
            $module->id_department = $request->id_department;
        }
        $module->date          = $request->date;
        $module->time          = $request->time;
        $module->save();

        return redirect('manage_training/'.$request->id_module);   

    }

    public function publish_training ($id_module){
        $module = ModulTraining::find($id_module);
        if ($module == null) {
            return "error: module not found";
        }
        $module->is_publish = 1;
        $module->save();

        return redirect('manage_training/'.$id_module);  
    }

    public function unpublish_training ($id_module){
        $module = ModulTraining::find($id_module);
        if ($module == null) {
            return "error: module not found";
        }
        $module->is_publish = 0;
        $module->save();

        return redirect('manage_training/'.$id_module);  
    }

    public function see_participant($id_module) {
        $module = ModulTraining::find($id_module);
        $module['chapter'] = Chapter::where('id_module',$id_module)->get();
        if ($module == null) {
            return "error: module not found";
        }
        $chapter_record = UserChapterRecord::where('id_module_training',$id_module)->distinct()->get(['id_user']);
        foreach ($chapter_record as $key => $record) {
            $record['user'] = User::find($record->id_user);
            $record['user']['list_chapter'] = UserChapterRecord::where('id_module_training',$id_module)->where('id_user',$record->id_user)->get();
            foreach ($record['user']['list_chapter'] as $key => $record_chaps) {
                $chapter = Chapter::find($record_chaps->id_chapter_training);
                if ($chapter->category == 1) {
                    $test = Test::where('id_chapter',$chapter->id)->first();
                    $all_question = UserTestRecord::where('id_test',$test->id)->where('id_user',$record_chaps->id_user)->get();
                    $true_answer = UserTestRecord::where('id_test',$test->id)->where('id_user',$record_chaps->id_user)->where('is_true',1)->get();
                    $score = (count($true_answer)/count($all_question))*100;
                    $record_chaps['score'] = $score;
                } else {
                    $record_chaps['score'] = '--';
                }
                
            }
        }
        return view('admin.training_see_participant')->with('module',$module)->with('chapter_record',$chapter_record);
    }

}


