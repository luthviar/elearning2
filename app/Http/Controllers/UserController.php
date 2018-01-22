<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Http\Request;
use App\User;
use App\ModulTraining;
use App\UserChapterRecord;
use App\OrganizationalStructure;
use App\EmployeeScore;
use App\LevelPosition;
use App\EmployeeStatus;
use App\OsDivision;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Session;
use App\RequestPassword;
use App\Auth;
use DB;
use App\Chapter;
use App\OsUnit;
use App\OsDepartment;
use App\JobFamily;
use App\Test;
use App\UserTestRecord;
use App\OsSection;
use Mail;
use URL;

class UserController extends Controller
{
    // MIDDLEWARE
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
             'forgot_password', 'forgot_password_submit', 'send_password', 'cobapdf', 'storepdf', 'view_pdf'
        ]]);
        $this->middleware('isAdmin', ['except' => [
             'forgot_password', 'forgot_password_submit', 'get_profile',
            'change_password', 'change_photo','send_password', 'cobapdf', 'storepdf', 'view_pdf'
        ]]);
    }

    public function cobapdf(){
        return view('cobapdf');
    }

    public function view_pdf(){
        return view('viewer-pdf.index');
    }

    public function storepdf(Request $request){
//        dd('masuk');
//        $file = $request->encoded;
        $file = $request->file('score');
        $filename1 = $request->file('files');
        $filename2 = $filename1->getClientOriginalName();
        $filename = $filename1->getClientOriginalName().'.txt';
//        File::put('file_encoded')
//        $thefile = file_put_contents($filename,$request->encoded);
//        Storage::
        $thefile = Storage::disk('public')->put($filename, $request->encoded);
        $theurl = Storage::disk('local')->url($filename);

//        "http://localhost/code_rohmat/public/viewer-pdf/viewer.html?file=WORKSHEET%205_3.pdf"
//        $to_file =
//        URL::asset
        $accessURL = URL::asset('viewer-pdf/viewer.html?file='.$filename2);
        dd($accessURL);

//        $destinationPath = 'file_encoded';
//        $movea = $thefile->move($destinationPath,$thefile->getClientOriginalName());
//        $url = "file_encoded/file={$file->getClientOriginalName()}";
//        dd($url);
//        $url =
        return redirect($accessURL);
//        return view('cobapdf')->with('url',$url);
    }

    public function get_profile () {

    	//get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

    	$user = new User();
    	$profile = $user->get_user_profile();

    	$training_record = new UserChapterRecord();
    	$training_record = $training_record->get_user_training_record(\Auth::user()->id);

        $scores = EmployeeScore::where('id_user',\Auth::user()->id)->orderBy('id','desc')->limit(10)->get();

        if ($scores == null){
            $scores;
        }

    	return view('user.profile')->with('profile', $profile)
            ->with('training_record', $training_record)->with('module', $modul)->with('scores',$scores);
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

//                $this->send_password($user->id);


//                return redirect('access');

                return redirect(action('UserController@send_password',$user->id));
            }
        }
        $request_password = new RequestPassword;
        $request_password->email = $request->email;
        $request_password->is_valid = 0;
        $request_password->save();
        $error = 'We cant find your email in our system';
        return view('user.forgot_password')->with('error',$error);
    }

    public function send_password($id_user) {
        $user = User::where('id',$id_user)->first();
//        dd('masuk');
        $pinrandom = mt_rand(100, 999)
            . mt_rand(100, 999);
        // shuffle the result
        $newpass = str_shuffle($pinrandom);


        $user->password = bcrypt($newpass);
        $user->save();

        $dataEmail = array(
            'name'=>$user->name,
            'newpass'=>$newpass
        );


        Mail::send(['html'=>'email-content.password-reset'],
            $dataEmail, function($message) use($user) {
                $message->to($user->email, $user->name)->subject
                ('[ALC] Informasi Ganti Password');
                $message->from('luthviar.a@gmail.com','Admin ELearning Aerofood');
            });

        Session::flash('success', 'Password Anda Berhasil diubah, Silahkan cek email Anda. di '.$user->email);

        return redirect('login');
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

        return view('admin.personnel.personnel_view_v1')->with('profile', $profile)->with('training_record', $training_record)->with('employee_record', $employee_record);
    }

    // ---------------------------------
    // ADMIN
    // ---------------------------------

    public function user_add (){
        $level_position = LevelPosition::all();
        $division = OsDivision::all();
        $unit = OsUnit::all();
        $department = OsDepartment::all();
        $section = OsSection::all();
        $status = EmployeeStatus::all();
        $job_family = JobFamily::all();

        return view('admin.personnel.personnel_add')->with('level_position',$level_position)->with('division',$division)
            ->with('status',$status)->with('job_family',$job_family)->with('unit',$unit)
            ->with('department',$department)->with('section',$section);
    }

    public function user_add_submit (Request $request){
        $division = OsDivision::find($request->division);
        $id_division = null;
        if ($division == null) {
            $id = DB::table('os_divisions')->insertGetId(
                [
                'division_name'    => $request->division_input,

                ]
            );
            $id_division = $id;
        } else {
            $id_division = $division->id;
        }

        $unit = OsUnit::find($request->unit);
        $id_unit = null;
        if ($unit == null) {
            $id = DB::table('os_units')->insertGetId(
                [
                'unit_name'    => $request->unit_input, 
                ]
            );
            $id_unit = $id;
        } else {
            $id_unit = $unit->id;
        }
        $department = OsDepartment::find($request->department);
        $id_department = null;
        if ($department == null) {
            $id = DB::table('os_departments')->insertGetId(
                [
                'department_name'    => $request->department_input, 
                'id_job_family'    => $request->job_family,
                ]
            );
            $id_department = $id;
        } else {
            $id_department = $department->id;
        }
        $section = OsSection::find($request->section);
        $id_section = null;
        if ($section == null) {
            $id = DB::table('os_sections')->insertGetId(
                [
                'section_name'    => $request->section_input, 
                ]
            );
            $id_section = $id;
        } else {
            $id_section = $section->id;
        }

       

        $id_user = DB::table('users')->insertGetId(
                [
                'name'          => $request->name, 
                'username'      => $request->username, 
                'email'         => $request->email, 
                'password'      => bcrypt($request->password), 
                'role'          => $request->role, 
                'education'     => $request->education, 
                'gender'        => $request->gender, 
                'birtdate'                      => $request->birtdate, 
                'date_join_acs'                 => $request->date_join_acs, 
                'position_name'                 => $request->position, 
                'flag_active'                   => 1, 
                'position'                      => $request->level_position, 
                'id_employee_status'            => $request->id_employee_status, 
                ]
            );
        $structure = new OrganizationalStructure;
        $structure->id_user = $id_user;
        $structure->id_division = $id_division;
        $structure->id_unit = $id_unit;
        $structure->id_section = $id_section;
        $structure->id_department = $id_department;
        $structure->save();

        $user_name = User::find($id_user);

//        dd('masuk');
        Session::flash('success', 'Anda berhasil menambahkan USER/Personnel baru dengan nama: '.$user_name->name.' dan profile-nya dapat dilihat di: ');
        Session::flash('success-personnel', $id_user);

        return redirect(url(action('UserController@personnel_list')));

    }

    public function edit_personnel ($id_personnel) {
        $user = User::find($id_personnel);
        if ($user == null) {
            return 'error:user not found';
        }
        $user['level'] = LevelPosition::find($user->position);
        $user['employee_status'] = EmployeeStatus::find($user->id_employee_status);
        $user['org_structure'] = OrganizationalStructure::where('id_user',$user->id)->first();

        $division = OsDivision::all();
        $unit = OsUnit::all();
        $department = OsDepartment::all();
        $section = OsSection::all();
        $level = LevelPosition::all();
        $status = EmployeeStatus::all();
        $job_family = JobFamily::all();
        $job_family_user = null;
        if ($user['org_structure'] != null) {
            $user_deps = OsDepartment::find($user['org_structure']->id_department);
            $job_family_user = JobFamily::find($user_deps->id_job_family);
        }
        

        return view('admin.personnel.personnel_edit')->with('user',$user)
            ->with('division',$division)->with('unit',$unit)
            ->with('section',$section)->with('department',$department)->with('level_position',$level)
            ->with('status',$status)->with('job_family', $job_family)->with('job_family_user',$job_family_user);
    }

    public function edit_personnel_submit (Request $request){
        $division = OsDivision::find($request->division);
        $id_division = null;
        if ($division == null) {
            $id = DB::table('os_divisions')->insertGetId(
                [
                'division_name'    => $request->division_input,

                ]
            );
            $id_division = $id;
        } else {
            $id_division = $division->id;
        }

        $unit = OsUnit::find($request->unit);
        $id_unit = null;
        if ($unit == null) {
            $id = DB::table('os_units')->insertGetId(
                [
                'unit_name'    => $request->unit_input, 
                ]
            );
            $id_unit = $id;
        } else {
            $id_unit = $unit->id;
        }
        $department = OsDepartment::find($request->department);
        $id_department = null;
        if ($department == null) {
            $id = DB::table('os_departments')->insertGetId(
                [
                'department_name'    => $request->department_input, 
                'id_job_family'    => $request->job_family,
                ]
            );
            $id_department = $id;
        } else {
            $id_department = $department->id;
        }
        $section = OsSection::find($request->section);
        $id_section = null;
        if ($section == null) {
            $id = DB::table('os_sections')->insertGetId(
                [
                'section_name'    => $request->section_input, 
                ]
            );
            $id_section = $id;
        } else {
            $id_section = $section->id;
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
        $user->save();

        $structure = OrganizationalStructure::where('id_user',$request->id_user)->first();
        if ($structure == null) {
            $structure = new OrganizationalStructure;
            $structure->id_user = $request->id_user;
        }
        $structure->id_division = $id_division;
        $structure->id_unit = $id_unit;
        $structure->id_section = $id_section;
        $structure->id_department = $id_department;
        $structure->save();

        Session::flash('success', 'Personnel berhasil di UPDATE');

        return redirect(action('UserController@profile_view',$request->id_user));

    }

    public function activate ($id_user){
        $user = User::find($id_user);
        if ($user == null) {
            return "error: user not found";
        }
        $user->flag_active = 1;
        $user->save();

        Session::flash('success', 'Personnel berhasil di-AKTIFKAN, sehingga user ini dapat login ke dalam E-Learning.');

        return redirect(action('UserController@profile_view',$user->id));
    }

    public function nonactivate ($id_user) {
        $user = User::find($id_user);
        if ($user == null) {
            return "error: user not found";
        }
        $user->flag_active = 0;
        $user->save();

        Session::flash('success', 'Personnel berhasil di-NONAKTIFKAN, sehingga user ini tidak dapat login ke dalam E-Learning.');

        return redirect(action('UserController@profile_view',$user->id));
    }

    public function add_score (Request $request) {
//        dd(empty($request->attachment_name));
//        $file = $request->file('score');
//        $url = null;
//        if (!empty($file)) {
//            $destinationPath = 'file_attachments';
//            $movea = $file->move($destinationPath,$file->getClientOriginalName());
//            $url = "ViewerJS/index.html#../file_attachments/{$file->getClientOriginalName()}";
//        }
//        if ($url == null) {
//            return 'error: file not found';
//        }

        $user = User::find($request->id_user);
        if ($user == null) {
            return 'error: user not found in database';
        }

        if(empty($request->attachment_name) || empty($request->encoded_file_score) || empty($request->file('score'))) {
            Session::flash('failed', 'Semua field input pada ADD SCORE wajib diisi.');
            return redirect(action('UserController@profile_view',$user->id));
        }

        // file pdf process
        $file = $request->file('score');
        $filename_ori = $file->getClientOriginalName();
        $filename_save = $file->getClientOriginalName().'.txt';

        Storage::disk('public')->put($filename_save, $request->encoded_file_score);

        $saveURL = 'view-pdf?file='.$filename_ori;
        // end of file pdf process

        $score = new EmployeeScore;
        $score->id_user = $request->id_user;
        $score->attachment_name = $request->attachment_name;
        $score->attachment_url  = $saveURL;
        $score->save();

        Session::flash('success', 'Score bernama: '.$request->attachment_name. ' berhasil ditambahkan.');

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

        return view('admin.personnel.personnel_see_record')->with('user',$user)->with('training', $training)->with('status',$status)->with('user_chapter',$user_chapter);
    }

    public function system_access () {
        return view('admin.request.access_system');
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
            $user = new User();
            foreach ($accesses as $access)
            {
                $nestedData['email'] = $access->email;
                if ($access->is_valid == 1) {
                    $nestedData['is_valid'] = "valid";
                } else {
                    $nestedData['is_valid'] = "not valid";
                }
//                $nestedData['created_at'] = date('j M Y',strtotime($access->created_at));
                $nestedData['created_at'] = $access->created_at->diffForHumans();

                $nestedData['action'] =
                    "<a href='".url(action('UserController@profile_view',$user->id))."'>"
                    .$user->name."</a>";


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

    public function delete_score($id_score) {
        $score = EmployeeScore::find($id_score);

        if ($score == null) {
            return "error: score not found";
        }
        $filename = substr($score->attachment_url,14);
        $path = public_path() . "\storage\\" . $filename.".txt";
        unlink($path);
        DB::table('employee_scores')->where('id','=',$id_score)->delete();

        Session::flash('success', 'Score bernama: '.$score->attachment_name. ' berhasil dihapus.');
        return redirect(action('UserController@profile_view',$score->id_user));
    }
}
