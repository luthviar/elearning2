<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ModulTraining;
use App\UserChapterRecord;
use App\EmployeeScore;

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

    public function profile_view( $id_user ){
        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        $user = new User();
        $profile = $user->profile_view( $id_user);

        $training_record = new UserChapterRecord();
        $training_record = $training_record->get_user_training_record($id_user);

        $employee_record = EmployeeScore::where('id_user', $id_user)->orderBy('id','desc')->get();

        return view('admin.personnel_view')->with('profile', $profile)->with('training_record', $training_record)->with('employee_record', $employee_record);
    }
}
