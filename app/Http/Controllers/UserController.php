<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\ModulTraining;

class UserController extends Controller
{
    
    public function get_profile () {

    	//get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

    	$user = new User();
    	$profile = $user->get_user_profile();

    	return view('profile')->with('profile', $profile)->with('module', $modul);
    }
}
