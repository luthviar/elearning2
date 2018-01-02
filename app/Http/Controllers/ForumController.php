<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\ModulTraining;

class ForumController extends Controller
{
    
    public function get_all_forum () {
    	$forum = new Forum();
    	$forum = $forum->get_all_forum();

    	echo $forum;
    }

    public function get_forum ( $id_forum ) {
    	$forum = new Forum();
    	$forum = $forum->get_forum( $id_forum );

    	echo $forum;
    }

    public function get_user_forum ( $forum_type ) {
        $forum = new Forum();

        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        if ( $forum_type == 'public') {
            $forums = $forum->get_forum_public();
            return view('forums_public')
                        ->with('forums', $forums)
                        ->with('module', $modul);

        } elseif ( $forum_type == 'job_family' ) {
            # code...
        } elseif ( $forum_type == 'department') {
            # code...
        } else {
            echo "error";
        }
    }
}
