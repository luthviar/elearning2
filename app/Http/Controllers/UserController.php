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
use Session;
use App\RequestPassword;
use App\Auth;
use App\Chapter;
use App\OsUnit;
use App\OsDepartment;
use App\Test;
use App\UserTestRecord;
use App\OsSection;

class UserController extends Controller
{
    // MIDDLEWARE
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
             'forgot_password', 'forgot_password_submit'
        ]]);
        $this->middleware('isAdmin', ['except' => [
             'forgot_password', 'forgot_password_submit', 'get_profile', 'change_password', 'change_photo'
        ]]);
        
    }
    
    public function get_profile () {

    	//get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

    	$user = new User();
    	$profile = $user->get_user_profile();

    	$training_record = new UserChapterRecord();
    	$training_record = $training_record->get_user_training_record(\Auth::user()->id);

        $score = EmployeeScore::where('id_user',\Auth::user()->id)->orderBy('id','desc')->first();

    	return view('user.profile')->with('profile', $profile)->with('training_record', $training_record)->with('module', $modul)->with('score',$score);
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

    public function change_photo(Request $request) {
        $user = User::find($request->id_user);
        if ($user == null) {
            return "error : user not found";
        }
        $image = $request->file('image');
        $url = null;
        if (!empty($image)) {
            $destinationPath = 'photo';
            $movea = $image->move($destinationPath,$image->getClientOriginalName());
            $url = "photo/{$image->getClientOriginalName()}";

            $user->photo = $url;
            $user->save();
        }

        return  redirect('profile');

    }

    public function forgot_password(){
        $error = null;
        return view('user.forgot_password')->with('error',$error);
    }

    public function forgot_password_submit(Request $request){
        $email = $request->email;
        if ($email != null) {
            $user = User::where('email',$email)->first();
            if ($user != null) {
                $request_password = new RequestPassword;
                $request_password->email = $request->email;
                $request_password->is_valid = 1;
                $request_password->save();

                return "ok";
            }
        }
        $request_password = new RequestPassword;
        $request_password->email = $request->email;
        $request_password->is_valid = 0;
        $request_password->save();
        $error = 'We cant find your email in our system';
        return view('user.forgot_password')->with('error',$error);
    }


    // -------------------------------------------
    //              ADMIN AREA
    // -------------------------------------------

    public function personnel_list () {
        $user = new User();
        $profile = $user->profile_view(\Auth::user()->id);
        $profile['level'] = LevelPosition::find($profile['personal_data']->position);

        Session::put('profile', $profile);
//        dd(Session::get('profile')['level']->nama_level);
        return view('admin.personnel.personnel');
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

                $nestedData['name'] =
                    "<a href='".url(action('UserController@profile_view',$user->id))."'>"
                    .$user->name."</a>";

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
        return view('admin.personnel.personnel_add');
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

        return view('admin.personnel.personnel_view')->with('profile', $profile)->with('training_record', $training_record)->with('employee_record', $employee_record);
    }

    // ---------------------------------
    // ADMIN
    // ---------------------------------

    public function user_add (){
        $level_position = LevelPosition::all();
        $division = OsDivision::all();
        $status = EmployeeStatus::all();

        return view('admin.personnel.personnel_add')->with('level_position',$level_position)->with('division',$division)->with('status',$status);
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

    public function system_access () {
        return view('admin.access_system');
    }

    public function system_access_serverside (Request $request) {
        $columns = array( 
                            0 =>'email', 
                            1 =>'is_valid',
                            2 => 'created_at',
                        );
  
        $totalData = RequestPassword::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {   
            $accesses = RequestPassword::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $accesses =  RequestPassword::where('email','LIKE',"%{$search}%")
                            ->orWhere('is_valid', 'LIKE',"%{$search}%")
                            ->orWhere('created_at', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = RequestPassword::where('email','LIKE',"%{$search}%")
                             ->orWhere('is_valid', 'LIKE',"%{$search}%")
                             ->orWhere('created_at', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($accesses))
        {
            foreach ($accesses as $access)
            {
                
                $nestedData['email'] = $access->email;
                if ($access->is_valid == 1) {
                    $nestedData['is_valid'] = "valid";
                } else {
                    $nestedData['is_valid'] = "not valid";
                }
                $nestedData['created_at'] = date('j M Y',strtotime($access->created_at));
                
                
                
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
}
