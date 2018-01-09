<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ModulTraining;
use App\UserChapterRecord;
use App\OrganizationalStructure;
use App\EmployeeScore;
use App\LevelPosition;
use App\EmployeeStatus;
use App\OsDivision;
use App\Chapter;
use App\OsUnit;
use App\OsDepartment;
use App\Test;
use App\UserTestRecord;
use App\OsSection;

class UserController extends Controller
{
    
    public function get_profile () {

    	//get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

    	$user = new User();
    	$profile = $user->get_user_profile();

    	$training_record = new UserChapterRecord();
    	$training_record = $training_record->get_user_training_record(\Auth::user()->id);

    	return view('user.profile')->with('profile', $profile)->with('training_record', $training_record)->with('module', $modul);
    }

    public function change_password ( Request $request) {
    	//get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

    	$change_password = $request->change_password;
    	$confirm_password = $request->confirm_password;
    	if ($change_password != $confirm_password) {
    		$error['message'] = 'new password and confirm password different';
    		return view('user.error')->with('error', $error)->with('module', $modul);
    	}
    	$user = new User();
    	$user = $user->change_password($confirm_password);
    	if ($user['status'] == 'error') {
    		return view('user.error')->with('error', $user)->with('module', $modul);
    	}
    	return redirect('/profile');
    }


    // -------------------------------------------
    //              ADMIN AREA
    // -------------------------------------------

    public function personnel_list () {
        return view('admin.personnel');
    }
    public function personnel_list_serverside (Request $request) {
        $columns = array( 
                            0 =>'name', 
                            1 =>'role',
                            2 => 'position_name',
                            3 => 'date_join_acs',
                            4 => 'flag_active',
                        );
  
        $totalData = User::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {   
            $users = User::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $users =  User::where('name','LIKE',"%{$search}%")
                            ->orWhere('position_name', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = User::where('name','LIKE',"%{$search}%")
                             ->orWhere('position_name', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($users))
        {
            foreach ($users as $user)
            {

                $nestedData['name'] = "<a href='".url('/personnel',$user->id)."'>".$user->name."</a>";
                if ($user->role == 1) {
                    $nestedData['role'] = "Administrator";
                } else {
                    $nestedData['role'] = "User";
                }
                $nestedData['position'] = $user['position_name'];
                $nestedData['date_join'] = date('j M Y',strtotime($user->date_join_acs));
                if ($user->flag_active == 1) {
                    $nestedData['flag_active'] = "Active";
                } else {
                    $nestedData['flag_active'] = "Non-Active";
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

    public function personnel_add()
    {
        return view('admin.personnel_add');
    }

    public function profile_view( $id_user ){
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        $user = new User();
        $profile = $user->profile_view( $id_user);

        $training_record = new UserChapterRecord();
        $training_record = $training_record->get_user_training_record($id_user);

        $employee_record = EmployeeScore::where('id_user', $id_user)->orderBy('id','desc')->get();


        $profile['level'] = LevelPosition::find($profile['personal_data']->position);

        return view('admin.personnel_view')->with('profile', $profile)->with('training_record', $training_record)->with('employee_record', $employee_record);
    }


    public function user_add (){
        $level_position = LevelPosition::all();
        $division = OsDivision::all();
        $status = EmployeeStatus::all();

        return view('admin.personnel_add')->with('level_position',$level_position)->with('division',$division)->with('status',$status);
    }

    public function user_add_submit (Request $request){
        $structure = OrganizationalStructure::where('id_division',$request->division)->where('id_unit',$request->unit)->where('id_department',$request->department)->where('id_section',$request->section)->first();
        if ($structure == null) {
            return "error: organization structure not found";
        }

        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = $request->role;
        $user->education = $request->education;
        $user->gender = $request->gender;
        $user->birtdate = $request->birtdate;
        $user->date_join_acs = $request->date_join_acs;
        $user->position_name = $request->position;
        $user->flag_active = 1;
        $user->position = $request->level_position;
        $user->id_employee_status = $request->id_employee_status;
        $user->id_organizational_structure = $structure->id;
        $user->save();

        return redirect('admin/personnel');

    }

    public function edit_personnel ($id_personnel) {
        $user = User::find($id_personnel);
        if ($user == null) {
            return 'error:user not found';
        }
        $user['level'] = LevelPosition::find($user->position);
        $user['employee_status'] = EmployeeStatus::find($user->id_employee_status);
        $user['org_structure'] = OrganizationalStructure::find($user->id_organizational_structure);

        $division = OsDivision::all();
        $unit = OsUnit::all();
        $department = OsDepartment::all();
        $section = OsSection::all();
        $level = LevelPosition::all();
        $status = EmployeeStatus::all();

        return view('admin.personnel_edit')->with('user',$user)->with('division',$division)->with('unit',$unit)->with('section',$section)->with('department',$department)->with('level_position',$level)->with('status',$status);
    }

    public function edit_personnel_submit (Request $request){
        $structure = OrganizationalStructure::where('id_division',$request->division)->where('id_unit',$request->unit)->where('id_department',$request->department)->where('id_section',$request->section)->first();
        if ($structure == null) {
            return "error: organization structure not found";
        }

        $user = User::find($request->id_user);
        if ($user == null) {
            return 'error: user not found';
        }

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        if ($request->password != null) {
            $user->password = bcrypt($request->password);
        }
        $user->role = $request->role;
        $user->education = $request->education;
        $user->gender = $request->gender;
        $user->birtdate = $request->birtdate;
        $user->date_join_acs = $request->date_join_acs;
        $user->position_name = $request->position;
        $user->flag_active = 1;
        $user->position = $request->level_position;
        $user->id_employee_status = $request->id_employee_status;
        $user->id_organizational_structure = $structure->id;
        $user->save();

        return redirect(action('UserController@personnel_list'));

    }

    public function activate ($id_user){
        $user = User::find($id_user);
        if ($user == null) {
            return "error: user not found";
        }
        $user->flag_active = 1;
        $user->save();

        return redirect(action('UserController@profile_view',$user->id));   
    }

    public function nonactivate ($id_user) {
        $user = User::find($id_user);
        if ($user == null) {
            return "error: user not found";
        }
        $user->flag_active = 0;
        $user->save();
        
        return redirect(action('UserController@profile_view',$user->id));   
    }

    public function add_score (Request $request) {
        $file = $request->file('score');
        $url = null;
        if (!empty($file)) {
            $destinationPath = 'file_attachments';
            $movea = $file->move($destinationPath,$file->getClientOriginalName());
            $url = "ViewerJS/index.html#../file_attachments/{$file->getClientOriginalName()}";
        }
        if ($url == null) {
            return 'error: file not found';
        }
        $user = User::find($request->id_user);
        if ($user == null) {
            return 'error: user not found';
        }
        $score = new EmployeeScore;
        $score->id_user = $request->id_user;
        $score->attachment_name = $request->attachment_name;
        $score->attachment_url  = $url;
        $score->save();

        return redirect(action('UserController@profile_view',$user->id)); 
    }

    public function see_record($id_personnel, $id_training){
        $user = User::find($id_personnel);
        if ($user == null) {
            return "error:user not found";
        }

        $training = ModulTraining::find($id_training);
        if ($training == null) {
            return "error: training not found";
        }

        $user_chapter = UserChapterRecord::where('id_user', $id_personnel)->where('id_module_training',$id_training)->get();
        $user_chapter_finish = UserChapterRecord::where('id_user', $id_personnel)->where('id_module_training',$id_training)->where('is_finish',1)->get();
        if ($user_chapter == null) {
            return "error: user record not found";
        }
        $status = 'finish';
        if (count($user_chapter) > count($user_chapter_finish)) {
            $status = 'unfinish';
        }

        foreach ($user_chapter as $key => $value) {
            $value['chapter'] = Chapter::find($value->id_chapter_training);
            if ($value['chapter'] != null) {
                 if ($value['chapter']->category == 1) {
                    $test = Test::where('id_chapter',$value->id_chapter_training)->first();
                    $value['test_record'] = UserTestRecord::where('id_test',$test->id)->where('id_user',$id_personnel)->get();
                    $true_answer = UserTestRecord::where('id_test',$test->id)->where('id_user',$id_personnel)->where('is_true',1)->get();
                    $value['score'] = (int) (count($true_answer)/count($value['test_record']))*100;
                }
            }
           
        }

        return view('admin.personnel_see_record')->with('user',$user)->with('training', $training)->with('status',$status)->with('user_chapter',$user_chapter);
    }
}
