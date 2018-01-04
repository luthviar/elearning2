<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ModulTraining;
use App\UserChapterRecord;

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
}
