<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\ModulTraining;
use App\JobFamily;
use App\Auth;
use App\UserChapterRecord;
use App\User;
use App\Material;
use App\FilesMaterial;
use App\Trainer;
use App\Chapter;
use App\UserTrainingAccess;
use App\Test;
use App\UserTestRecord;
use App\OrganizationalStructure;
use App\OsDepartment;
use App\Question;
use App\QuestionOption;
use DB;
use Session;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin', ['except' => [
             'get_module_training', 'get_trainings','get_material','finish_chapter','get_test','submit_test','review_test','next_chapter','request_access'
        ]]);
        
    }
    
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
            $department =OsDepartment::all();
            foreach ($trainings['children'] as $key => $children) {
                $user_access = new UserTrainingAccess();
                $children['access'] = $user_access->check_access(\Auth::user()->id, $children->id);
            }
            $job_family = JobFamily::all();
            
            return view('user.training.module_training')
                ->with( 'trainings', $trainings)->with('module', $modul)->with('department',$department)->with('job_family',$job_family);
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

//        dd(Session::get('training'));
        return view('user.training.intro_training')
            ->with('training', $trainings2)->with('module', $modul)
            ->with('finish_chapter', $finish_chapter2);
    	

    }

    public function get_material( $id_chapter ) {
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

//        $trainings = Session::get('trainings');

        $material = new Material();
        $material_training = $material->get_material ( $id_chapter);

        if(	$material_training['status'] == 'error_material') {
            return view('user.error')->with('error', $material_training['message']);
        }

        $chapter = new Chapter();
        $chapter = $chapter->get_chapter($material_training->id_chapter);
        if ($chapter['status'] == 'error') {
            return view('user.error')->with('error', $chapter)->with('module', $modul);
        }
        $chapter['material'] = $material_training;

        $is_finish = UserChapterRecord::where('id_user',\Auth::user()->id)->where('id_chapter_training',$id_chapter)->first();

        return view('user.training.material')->with('chapter', $chapter)->with('module', $modul)->with('is_finish',$is_finish);
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
            return redirect(action('TrainingController@get_trainings',$record->id_module_training));
        }
        if ($next_chapter['chapter']->category == 0) {
            return redirect(action('TrainingController@get_material',$next_chapter['chapter']->id));
        } else {
            return redirect(action('TrainingController@get_test',$next_chapter['chapter']->id));
        }
        
        
    }

    public function get_test ( $id_chapter ) {
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        $test = new Test();
        $test = $test->get_test($id_chapter);

//        dd($test);

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




        // start test of training
        return view('user.training.online_test')
            ->with('chapter', $chapter)->with('test',$test)
            ->with('module',$modul)->with('char',$char)->with('record',$record_session);

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
        

        return view('user.training.online_test_review')
            ->with('chapter', $chapter)->with('record', $user_record)->with('module', $modul);
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

    public function request_access ( $id_training ) {
        $user = User::find(\Auth::user()->id);
        if ($user == null) {
            return "error : user not found";
        }
        $module = ModulTraining::find($id_training);
        if ($module == null) {
            return "error : module not found";
        }
        $access = UserTrainingAccess::where('id_module', $id_training)->where('id_user',$user->id)->first();
        if ($access == null) {
            $access = new UserTrainingAccess;
            $access->id_user = $user->id;
            $access->id_module = $module->id;
            $access->status = 0;
            $access->save();
        }
        return redirect('get_training/'.$module->id_parent);
    }

    // ----------------------------------
    // ADMIN AREA
    // ----------------------------------

    public function schedule (){
        return view('admin.training.training_jadwal');
    }

    public function schedule_serverside(Request $request){
        $columns = array( 
                            0 =>'modul_name', 
                            1 =>'date',
                            2 => 'time',
                            3 => 'id',
                            4 => 'id',
                            5 => 'created_by'
                        );
  
        $totalData = ModulTraining::where('is_child', 1)->count();
//            $totalData = 2;
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
//                         ->whereDate('date','>=', DB::raw('CURDATE()'))
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $ModulTraining =  DB::table('modul_trainings')
                            ->where('modul_trainings.is_child','=',1)
                            ->where(function($query) use ($search){
                                $query->where('modul_trainings.modul_name', 'LIKE',"%{$search}%");
                                $query->orWhere('modul_trainings.description','LIKE',"%{$search}%");
                            })
//                            ->whereDate('date','>=', DB::raw('CURDATE()'))
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
                             ->whereDate('date','>=', DB::raw('CURDATE()'))
                             ->count();
        }

        $data = array();
        if(!empty($ModulTraining))
        {
            foreach ($ModulTraining as $module)
            {

                $nestedData['modul_name'] = "<a href='".url('admin/training/manage-'.$module->id)."'>".$module->modul_name."</a>";
                $nestedData['date'] = date('j M Y',strtotime($module->date));
                $nestedData['time'] = $module->time;
                $nestedData['partisipant'] = "<a href='".url('admin/training/participant-'.$module->id)."'>
                                                see participant<a>";
                $trainer = Trainer::where('id_module',$module->id)->get();
                $text ="<ul style='list-style-type: none;'>";
                foreach ($trainer as $key => $trains) {
                    $text= $text ."<li>".($key+1).". ".$trains->trainer_name."</li>";
                }
                $text = $text ."</ul>";
                $nestedData['trainer'] = $text;
                $user = User::find($module->created_by);
                $nestedData['created_by'] = $user->name;
                
                
                
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

    

    public function give_access ($id_user_training_access) {
        $access = UserTrainingAccess::find($id_user_training_access);
        if ($access == null) {
            return 'error : access not found';
        }
        $access->status = 1;
        $access->save();

        $user = User::find($access->id_user);
        Session::flash('success', 'Anda berhasil melakukan "GIVE ACCESS" pada karyawan yang bernama: '.$user->name);

        return redirect(action('TrainingController@admin_access_training'));
    }

    public function cancel_access ( $id_user_training_access ){
        $access = UserTrainingAccess::find($id_user_training_access);
        if ($access == null) {
            return 'error : access not found';
        }
        $access->status = 0;
        $access->save();

        $user = User::find($access->id_user);
        Session::flash('success', 'Anda berhasil melakukan "CANCEL ACCESS" pada karyawan yang bernama: '.$user->name);

        return redirect(action('TrainingController@admin_access_training'));
    }

    public function add_training (){
        $parent = ModulTraining::where('is_child',0)->get();
        $department = OsDepartment::all();
        $job_family = JobFamily::all();
        return view('admin.training.training_add')
            ->with('parent',$parent)->with('department',$department)->with('job_family',$job_family);
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
                'id_job_family' => $request->id_job_family,
                'is_active'     => 1,
                'is_publish'    => 0,
                'is_child'      => 1,
                'created_by'    => \Auth::user()->id
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
                'created_by'    => \Auth::user()->id
                ]
            );
        }
        if ($request->trainer_name[0] != null) {
            for ($ii=0; $ii < count($request->trainer_name); $ii++) { 
                $trainer = new Trainer;
                $trainer->id_module = $id;
                $trainer->trainer_name = $request->trainer_name[$ii];
                $trainer->trainer_info = $request->trainer_info[$ii];
                $trainer->save();
            }
        }

        return redirect(action('TrainingController@manage_training', $id));
    }

    public function manage_training($id_training){
        // get parent training
        $parent = ModulTraining::where('is_child',0)->get();

        $training = ModulTraining::find($id_training);
        if ($training == null) {
            return "error";
        }
        $chapter = Chapter::where('id_module',$training->id)->orderBy('sequence')->get();
        if (count($chapter) != 0) {
            foreach ($chapter as  $chaps) {
                if ($chaps->category == 0) {
                    $material = new Material();
                    $chaps['material'] = $material->get_material($chaps->id);
                }else{
                    // $test = new Test();
                    // $chaps['test'] = $test->get_manage_test($chaps->id);
                    $chaps['test'] = Test::where('id_chapter',$chaps->id)->first();
                    if ($chaps['test'] == null) {
                        return "error: test not found";
                    }
                    $chaps['test']['questions'] = Question::where('id_test', $chaps['test']->id)->get();
                    if (count($chaps['test']['questions']) > 0) {
                        foreach ($chaps['test']['questions'] as $key => $question) {
                            $question['option'] = QuestionOption::where('id_question',$question->id)->get();
                        }
                    }
                }
            }
        }
        $training['chapter'] = $chapter;
        $trainer = Trainer::where('id_module',$id_training)->get();

        Session::put('training',$training);
        Session::put('parent',$parent);
        Session::put('trainer',$trainer);

//        dd($training['chapter']);
        return view('admin.training.training_manage')->with('training',$training)->with('parent',$parent)->with('trainer',$trainer);
    }

    public function add_chapter ($id_module) {
        $modul= ModulTraining::find($id_module);
        if ($modul == null) {
            return "error : module not found";
        }
        return view('admin.training.training_add_chapter')->with('module',$modul);

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
        
        return redirect(action('TrainingController@manage_chapter',$id));


    }

    public function manage_chapter($id_chapter) {
        $chapter = Chapter::find($id_chapter);
//        $modul = Chapter::where('id_module', $id_chapter)->orderBy('sequence','desc')->first();

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

        Session::put('id_chapter',$id_chapter);

        return view('admin.training.training_manage_chapter')->with('chapter',$chapter);
    }

    public function add_question_submit(Request $request){

        if (empty($request->question_text)) {
            Session::flash('failed', 'Field Question Content tidak boleh kosong.');
            return redirect()->back();
        }

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
        
        return redirect(action('TrainingController@select_answer', $id));
    }

    public function select_answer ($id_question) {
        $question = Question::find($id_question);
        if ($question == null) {
            return "error: question not found";
        }
        $question['option'] = QuestionOption::where('id_question',$id_question)->get();

        return view('admin.training.training_select_option_true')->with('question',$question);
    }

    public function select_answer_submit (Request $request) {
        $id_true_answer = $request->true_answer;
        $option = QuestionOption::find($id_true_answer);
        $option->is_true = 1;
        $option->save();

        $question = Question::find($option->id_question);
        $test = Test::find($question->id_test);
        return redirect(action('TrainingController@manage_chapter',$test->id_chapter));
    }

    public function remove_question ($id_question) {
        $question = Question::find($id_question);
        if ($question == null) {
            return "error : question not found";
        }
        $test = Test::find($question->id_test);
        DB::table('question_options')->where('id_question','=',$id_question)->delete();
        DB::table('questions')->where('id','=',$id_question)->delete();

        return redirect(action('TrainingController@manage_chapter',$test->id_chapter));
    }

    public function edit_question($id_question) {
        $question = Question::find($id_question);
        if ($question== null) {
            return "error : question not found";
        }
        $question['option'] = QuestionOption::where('id_question',$id_question)->get();

        return view('admin.training.training_edit_question')->with('question',$question);
    }

    public function edit_question_submit (Request $request) {
        $question = Question::find($request->question_id);
        if ($question == null) {
            return "error : question not found";
        }

        if (empty($request->question_text)) {
            Session::flash('failed', 'Field Question Content tidak boleh kosong.');
            return redirect()->back();
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
        

        return redirect(action('TrainingController@select_answer', $question->id));
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

        return view('admin.training.training_edit_chapter_overview')->with('chapter', $chapter);

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
                $test->time = $request->time;
                $test->save();
            } else {
                $test->description = $request->description;
                $test->time = $request->time;
                $test->save();
            }
        }

        return redirect(action('TrainingController@manage_chapter', $request->id_chapter));
    }

    public function remove_chapter ($id_chapter){
        $chapter = Chapter::find($id_chapter);
        if ($chapter== null) {
            return "error:chapter not found";
        }
        if($chapter->category == 0){
            // chapter is material
            $material = Material::where('id_chapter', $chapter->id)->first();
            if($material == null) {
                // if no material --> delete chapter
                DB::table('chapters')->where('id','=',$chapter->id)->delete();
            }else{
                // delete file material, material, and chapter
                $file_material = FilesMaterial::where('id_material', $material->id)->get();
                if(count($file_material) == 0){
                    DB::table('materials')->where('id','=',$material->id)->delete();
                }else {
                    foreach($file_material as $file){
                        $filename = substr($file->url,14);
                        $path = public_path() . "\storage\\" . $filename.".txt";
                        unlink($path);
                    }
                    DB::table('files_materials')->where('id_material','=',$material->id)->delete();
                    DB::table('materials')->where('id','=',$material->id)->delete();
                }
                DB::table('chapters')->where('id','=',$chapter->id)->delete();
            }
        }else{
            // chapter is test
            $test = Test::where('id_chapter', $chapter->id)->first();
            if($test == null){
                // if no test found
                DB::table('chapters')->where('id','=',$chapter->id)->delete();
            } else {
                $questions = Question::where('id_test', $test->id)->get();
                if (count($questions) == 0){
                    DB::table('tests')->where('id','=',$test->id)->delete();
                    DB::table('chapters')->where('id','=',$chapter->id)->delete();
                }else {
                    foreach($questions as $question){
                        DB::table('question_options')->where('id_question','=',$question->id)->delete();
                    }
                    DB::table('questions')->where('id_test','=',$test->id)->delete();
                    DB::table('user_test_records')->where('id_test','=',$test->id)->delete();
                    DB::table('tests')->where('id','=',$test->id)->delete();
                    DB::table('chapters')->where('id','=',$chapter->id)->delete();
                }
            }
        }
        DB::table('user_chapter_records')->where('id_chapter_training','=',$id_chapter)->delete();
        $id_module = $chapter->id_module;
        DB::table('chapters')->where('id','=',$id_chapter)->delete();

        return redirect(action('TrainingController@manage_training',$id_module));
    }

    public function admin_training () {
        return view('admin.training.training');
    }

    public function admin_training_serverside( Request $request) {
        $columns = array( 
                            0 =>'modul_name', 
                            1 =>'id_parent',
                            2 => 'description',
                            3 => 'date',
                            4 => 'time',
                            5 => 'created_by',
                            6 => 'is_publish',
                            7 => 'created_at'
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

                $nestedData['modul_name'] =
                    "<a href='".url(action('TrainingController@manage_training',$module->id))."'>"
                    .$module->modul_name."</a>";

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
                $user = User::find($module->created_by);
                $nestedData['created_by'] = "<a href='".url('admin/personnel/view-'.$user->id)."'>".$user->name."</a>";
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

        if(empty($request->attachment_name) ||
            empty($request->encoded_file) ||
            empty($request->file('file'))
        ) {
            Session::flash('failed', 'Semua field input pada Form Upload File Material wajib diisi.');
            return redirect(action('TrainingController@manage_chapter',$material->id_chapter));
        }

        // file pdf process
        $file = $request->file('file');
        $filename_ori = $file->getClientOriginalName();
        $filename_save = $file->getClientOriginalName().'.txt';

        Storage::disk('public')->put($filename_save, $request->encoded_file);

        $saveURL = 'view-pdf?file='.$filename_ori;
        // end of file pdf process

        // old pdf process
        //$url = null;
        //if (!empty($file)) {
        //    $destinationPath = 'file_attachments';
        //    $movea = $file->move($destinationPath,$file->getClientOriginalName());
        //    $url = "ViewerJS/index.html#../file_attachments/{$file->getClientOriginalName()}";
        //}
        // end of old pdf process

        $attachment = new FilesMaterial;
        $attachment->id_material = $request->id_material;
        $attachment->name = $request->attachment_name;
        $attachment->url = $saveURL;
        $attachment->save();

        Session::flash('success', 'File Material berhasil ditambahkan');

        return redirect(action('TrainingController@manage_chapter',$material->id_chapter));
    }

    public function remove_material_file($id_file){

        $file = FilesMaterial::find($id_file);
        if ($file == null) {
            return "error : file material not found";
        }
        $material = Material::find($file->id_material);
        if ($file->url != null) {
            $filename = substr($file->url,14);
            $path = public_path() . "\storage\\" . $filename.".txt";
            unlink($path);
        }
        
       DB::table('files_materials')->where('id','=',$id_file)->delete();

       return redirect(action('TrainingController@manage_chapter',$material->id_chapter));
    }

    public function edit_training( $id_training){
        $module = ModulTraining::find($id_training);
        $parent = ModulTraining::where('is_child', 0)->get();
        if ($module == null) {
            return "error: module not found";
        }
        $department = OsDepartment::all();
        $job_family = JobFamily::all();

        $trainer = Trainer::where('id_module', $id_training)->get();

        return view('admin.training.training_edit')->with('module', $module)->with('parent',$parent)->with('department',$department)->with('trainer', $trainer)->with('job_family',$job_family);
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
            $module->id_job_family = $request->id_job_family;
        }
        $module->date          = $request->date;
        $module->time          = $request->time;
        $module->save();

        DB::table('trainers')->where('id_module','=',$module->id)->delete();

        if ($request->trainer_name[0] != null) {
            for ($ii=0; $ii < count($request->trainer_name); $ii++) { 
                $trainer = new Trainer;
                $trainer->id_module = $module->id;
                $trainer->trainer_name = $request->trainer_name[$ii];
                $trainer->trainer_info = $request->trainer_info[$ii];
                $trainer->save();
            }
        }

        return redirect(action('TrainingController@manage_training',$request->id_module));

    }

    public function publish_training ($id_module){
        $module = ModulTraining::find($id_module);
        if ($module == null) {
            return "error: module not found";
        }
        $chapters = Chapter::where('id_module',$module->id)->get();
        if(count($chapters) == 0){
            return "error: training mush have 1 or more chapter";
        }
        foreach($chapters as $chapter){
            if( $chapter->category == 0){
                $material = Material::where('id_chapter', $chapter->id)->first();
                if($material == null){
                    return "error: Material in Chapter".$chapter->chapter_name." not found";
                }
                $material_attachments = FilesMaterial::where('id_material',$material->id)->get();
                if(count($material_attachments)== 0){
                    return "error: File Material in Chapter ".$chapter->chapter_name." cannot must more than 1";
                }
            }else{
                $test = Test::where('id_chapter', $chapter->id)->first();
                if($test == null) {
                    return "error: Test in Chapter ".$chapter->chapter_name." not found";
                }
                $questions = Question::where('id_test',$test->id)->get();
                if(count($questions) == 0){
                    return "error: Question in chapter ".$chapter->chapter_name." must more than one";
                }
                foreach($questions as $question){
                    $options = QuestionOption::where('id_question',$question->id)->get();
                    if(count($options) == 0){
                        return "error: Option in chapter ". $chapter->chapter_name." not found";
                    }
                }
                
            }
        }
        $module->is_publish = 1;
        $module->save();

        Session::flash('success', 'Traininig ini berhasil di-PUBLISH. User sudah dapat mengakses training ini.');

        return redirect(action('TrainingController@manage_training',$id_module));
    }

    public function unpublish_training ($id_module){
        $module = ModulTraining::find($id_module);
        if ($module == null) {
            return "error: module not found";
        }
        $module->is_publish = 0;
        $module->save();

        Session::flash('success', 'Traininig ini berhasil di UN-PUBLISH. User TIDAK dapat mengakses training ini.');

        return redirect(action('TrainingController@manage_training',$id_module));
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
        return view('admin.training.training_see_participant')->with('module',$module)->with('chapter_record',$chapter_record);
    }

    public function admin_access_training(){
        return view('admin.request.access_training');
    }

    public function admin_access_training_serverside(Request $request){
        $columns = array( 
                            0 =>'id_user', 
                            1 =>'id_module',
                            2 => 'status',
                            3 => 'created_at',
                            4 => 'id'
                        );
  
        $totalData = UserTrainingAccess::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {   
            $accesses = UserTrainingAccess::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $accesses =  DB::table('user_training_accesses')
                            ->orderBy($order,$dir)
                            ->limit($limit)
                            ->offset($start)
                            ->get();


            $totalFiltered = DB::table('user_training_accesses')
                            ->count();
        }

        $data = array();
        if(!empty($accesses))
        {
            foreach ($accesses as $key=>$access)
            {
                $user = User::find($access->id_user);
                $nestedData['name'] = "<a target='_blank' href='".url(action('UserController@profile_view',$user->id))."'>"
                    .$user->name."</a>";
                $modul = ModulTraining::find($access->id_module);
                $nestedData['training'] = "<a target='_blank' href='".url(action('TrainingController@manage_training',$modul->id))."'>"
                    .$modul->modul_name."</a>";
                if ($access->status == 1) {
                    $nestedData['status'] = "accepted";
                } else {
                    $nestedData['status'] = "requested";
                }
//                $nestedData['updated_at'] = date('j M Y',strtotime($access->updated_at));
//                $nestedData['updated_at'] = $access->updated_at->diffForHumans();
                $nestedData['created_at'] =
                    '<i class="fa fa-info-circle"
       data-toggle="tooltip"
       data-placement="bottom"
       title='.date('jS_F_Y_g:i:s_a',strtotime($access->created_at)).'
       aria-hidden="true"></i> '. $access->created_at->diffForHumans() ;

                if ($access->status == 0) {
                    $nestedData['action'] = "<a href='".url(action('TrainingController@give_access',$access->id)).
                        "' class='btn btn-success'>give access</a>";
                } else {
                    $nestedData['action'] = "<a href='".url(action('TrainingController@cancel_access',$access->id)).
                        "' class='btn btn-danger'>cancel access</a>";
                }

                
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

    public function add_participant ($id_training){
        $training =ModulTraining::find($id_training);
        if ($training == null) {
            return "error : training not found";
        }
        $partisipant = array();
        $notparticipant = array();
        if ($training->id_parent == 1 or $training->id_parent == 2) {
            $partisipant = User::where('flag_active',1)->get();
        }elseif ($training->id_parent == 3) {
            $module = ModulTraining::find($id_training);
            $department_module = OsDepartment::find($module->id_department);
            if ($department_module == null) {
                return "error : department module not found";
            }
            $users = User::where('flag_active',1)->get();
            foreach ($users as $key => $user) {
                $structure = OrganizationalStructure::find($user->id);
                if ($structure == null) {
                    return "error: org. structure user not found";
                }
                $department_user = OsDepartment::find($structure->id_department);
                if ($department_user == null) {
                    return "error: department user not found";
                }
                if ($department_user->id_job_family == $department_module->id_job_family) {
                    array_push($partisipant, $user);
                }
            }
            $access = UserTrainingAccess::where('id_module',$id_training)->get();
            foreach ($access as $key => $value) {
                $user = User::find($value->id_user);
                array_push($partisipant, $user);
            }
        }elseif ($training->id_parent == 4) {
            $partisipant = User::where('position','>',5)->get();
            $access = UserTrainingAccess::where('id_module',$id_training)->get();
            foreach ($access as $key => $value) {
                $user = User::find($value->id_user);
                $in = false;
                foreach ($partisipant as $key => $value) {
                    if ($user->id == $value->id) {
                        $in =true;
                    }
                }
                if ($in == false) {
                    $partisipant[] = $user;
                }
                
            }
        }else{
            $access = UserTrainingAccess::where('id_module',$id_training)->get();
            foreach ($access as $key => $value) {
                $user = User::find($value->id_user);
                array_push($partisipant, $user);
            }
        }
        $users = User::all();

        return view('admin.training.training_participant')->with('training', $training)->with('participant',$partisipant)->with('users',$users);
    }

    public function add_participant_submit(Request $request){
        $module = ModulTraining::find($request->id_training);
        if ($module->id_parent != 1 or $module->id_parent != 2) {
            if ($module->id_parent == 5) {
                $access = UserTrainingAccess::where('id_module', $request->id_training)->where('id_user',$request->user)->first();
                if ($access == null) {
                    $access = new UserTrainingAccess;
                    $access->id_user = $request->user;
                    $access->id_module = $request->id_training;
                    $access->status = 1;
                    $access->save();
                } else {
                    $access->status = 1;
                    $access->save();
                }
            } elseif ($module->id_parent == 4) {
                $user = User::find($request->user);
                if ($user->position <= 5) {
                    $access = UserTrainingAccess::where('id_module', $request->id_training)->where('id_user',$request->user)->first();
                    if ($access == null) {
                        $access = new UserTrainingAccess;
                        $access->id_user = $request->user;
                        $access->id_module = $request->id_training;
                        $access->status = 1;
                        $access->save();
                    } else {
                        $access->status = 1;
                        $access->save();
                    }
                }
            } elseif($module->id_parent == 3) {
                $user = User::find($request->user);
                $structure = OrganizationalStructure::find($user->id);
                if ($structure == null) {
                    return "error : org. struture user not found";
                }
                $department_user = OsDepartment::find($structure->id_department);
                if ($department_user == null) {
                    return "error : department user not found";
                }

                $module = ModulTraining::find($request->id_training);
                $department_module = OsDepartment::find($module->id_department);
                if ($department_module == null) {
                    return "error : department module not found";
                }

                if ($department_module->id_job_family != $department_user->id_job_family) {
                    $access = UserTrainingAccess::where('id_module', $request->id_training)->where('id_user',$request->user)->first();
                    if ($access == null) {
                        $access = new UserTrainingAccess;
                        $access->id_user = $request->user;
                        $access->id_module = $request->id_training;
                        $access->status = 1;
                        $access->save();
                    } else {
                        $access->status = 1;
                        $access->save();
                    }
                }
            }
            
        }

        $nama_user = User::find($request->user);

        Session::flash('success', 'Anda berhasil menambah participant pada training ini dengan nama karyawan : '.$nama_user->name);
        return redirect()->back();
    }

    public function delete_training ( $id_training ) {
        $training = ModulTraining::find($id_training);
        if($training == null) {
            return "error: training not found";
        }
        if($training->is_child == 0){
            return "error: training is module training";
        }
        $chapters = Chapter::where('id_module', $id_training)->get();
        if(count($chapters) == 0){
            // training with no chapter -- delete and return to view all
            DB::table('user_chapter_records')->where('id_module_training','=',$id_training)->delete();
            DB::table('user_training_accesses')->where('id_module','=',$id_training)->delete();
            DB::table('modul_trainings')->where('id','=',$id_training)->delete();
            return redirect('admin/training/all');
        }else {
            // training with chapter
            foreach($chapters as $chapter){
                if($chapter->category == 0){
                    // chapter is material
                    $material = Material::where('id_chapter', $chapter->id)->first();
                    if($material == null) {
                        // if no material --> delete chapter
                        DB::table('chapters')->where('id','=',$chapter->id)->delete();
                    }else{
                        // delete file material, material, and chapter
                        $file_material = FilesMaterial::where('id_material', $material->id)->get();
                        if(count($file_material) == 0){
                            DB::table('materials')->where('id','=',$material->id)->delete();
                        }else {
                            foreach($file_material as $file){
                                $filename = substr($file->url,14);
                                $path = public_path() . "\storage\\" . $filename.".txt";
                                unlink($path);
                            }
                            DB::table('files_materials')->where('id_material','=',$material->id)->delete();
                            DB::table('materials')->where('id','=',$material->id)->delete();
                        }
                        DB::table('chapters')->where('id','=',$chapter->id)->delete();
                    }
                }else{
                    // chapter is test
                    $test = Test::where('id_chapter', $chapter->id)->first();
                    if($test == null){
                        // if no test found
                        DB::table('chapters')->where('id','=',$chapter->id)->delete();
                    } else {
                        $questions = Question::where('id_test', $test->id)->get();
                        if (count($questions) == 0){
                            DB::table('tests')->where('id','=',$test->id)->delete();
                            DB::table('chapters')->where('id','=',$chapter->id)->delete();
                        }else {
                            foreach($questions as $question){
                                DB::table('question_options')->where('id_question','=',$question->id)->delete();
                            }
                            DB::table('questions')->where('id_test','=',$test->id)->delete();
                            DB::table('user_test_records')->where('id_test','=',$test->id)->delete();
                            DB::table('tests')->where('id','=',$test->id)->delete();
                            DB::table('chapters')->where('id','=',$chapter->id)->delete();
                        }
                    }
                }
                
            }
            DB::table('user_chapter_records')->where('id_module_training','=',$id_training)->delete();
            DB::table('user_training_accesses')->where('id_module','=',$id_training)->delete();
            DB::table('modul_trainings')->where('id','=',$id_training)->delete();
            return redirect('admin/training/all');
        }
    }

    function change_order ($id_training){
        $training = ModulTraining::find($id_training);
        if($training == null ){
            return "error: training not found";
        }
        if ($training->is_child == 0){
            return "error: training is parent modul";
        }
        $chapters = Chapter::where('id_module', $id_training)->get();
        if(count($chapters) == 0){
            // no chapter found
            return redirect()->back();
        }
        $training['chapters'] = $chapters;
        return view('admin.training.reorder_chapter')->with('training',$training);
    }

    function change_order_submit (Request $request){
        $training = ModulTraining::find($request->id_training);
        if($training == null ){
            return "error: training not found";
        }
        if ($training->is_child == 0){
            return "error: training is parent modul";
        }
        $chapters = Chapter::where('id_module', $request->id_training)->get();
        if(count($chapters) == 0){
            Session::flash('failed', 'Mohon urutkan dengan baik dan sesuai.');
            return redirect()->back();
        }
        $order_change = array();
        foreach($chapters as $key => $chapter){
            $chapter_id = $request->$key;
            if(count($order_change) > 0){
                foreach($order_change as $change){
                    if($change == $chapter_id){
                        // ada chapter yang dipilih pada 2 urutan yang berbeda
                        Session::flash('failed', 'Mohon urutkan dengan baik dan sesuai.');
                        return redirect()->back();
                    } 
                }
            }
            array_push($order_change, $chapter_id);
        }
        foreach($chapters as $key => $chapter){
            $chapter = Chapter::find($request->$key);
            $chapter->sequence = $key;
            $chapter->save();
        }
        Session::flash('success', 'Re-Order Chapter berhasil dilakukan.');

        return redirect(action('TrainingController@manage_training',$request->id_training));
    }

}


