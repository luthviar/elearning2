<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\ModulTraining;
use App\Chapter;

class UserChapterRecord extends Model
{
    
    
	public function is_user_has_record ( $id_user , $id_module_training ) {
		$module = ModulTraining::find($id_module_training);
    	if ($module == null) {
    		return "error : training not found";
    	}
		$record = UserChapterRecord::where('id_user', $id_user)->where('id_module_training', $module->id)->get();
		if (count($record) == 0 || $record == null) {
			return "no";
		}
		return "yes";
	}


    public function add_user_chapter_record_initiate ( $id_user , $id_module_training){

    	// check user and module + validate
    	$user = User::find($id_user);
    	if ( $user == null) {
    		return "error : user not found";
    	}
    	$module = ModulTraining::find($id_module_training);
    	if ($module == null) {
    		return "error : training not found";
    	}
    	$module_children = ModulTraining::where('id_parent', $id_module_training)->get();
    	if ( count( $module_children ) != 0) {
    		return "error : training is module ";
    	}
    	$chapters = Chapter::where('id_module' , $id_module_training)->orderBy('sequence', 'asc')->get();
    	if ( count($chapters) == 0) {
    		return "error : training not ready";
    	}

    	// Save initiate user_chapter_record
    	foreach ($chapters as $chapter) {
    		$user_chapter_record 						= new UserChapterRecord();
	    	$user_chapter_record->id_user 				= $id_user;
	    	$user_chapter_record->id_chapter_training	= $chapter->id;
	    	$user_chapter_record->is_finish				= 0;
	    	$user_chapter_record->id_module_training	= $id_module_training;
	    	$user_chapter_record->save();
    	}

    	return "selesai";
    }

    public function check_finish_chapter ( $id_user , $id_module_training ) {
    	$module = ModulTraining::find($id_module_training);
    	if ($module == null) {
    		return "error : training not found";
    	}
    	$finish_chapter = UserChapterRecord::where('id_user', $id_user)
    									->where ('id_module_training', $id_module_training)
    									->where ('is_finish' , 1)
    									->get();
   		$count_finish_chapter = count($finish_chapter) +1;

    	return $count_finish_chapter;
    }

    public function record_chapter ( $id_user, $id_chapter) {
    	$user = User::find($id_user);
    	$error['status'] = 'error';
    	if ( $user == null) {
    		$error['message'] = 'no user found';
    		return $error;
    	}
    	$chapter = Chapter::find($id_chapter);
    	if ($chapter == null) {
    		$error['message'] = 'no chapter found';
    		return $error;
    	}
    	$record = UserChapterRecord::where('id_user', $id_user)->where('id_chapter_training', $id_chapter)->first();
    	if ($record == null) {
    		$error['message'] = 'please dont hack system';
    		return $error;
    	}
    	$record->is_finish = 1;
    	$record->save();

    	$record['status'] ='success';

    	return $record;
    }

    public function get_user_training_record( $id_user ){
    	$records = UserChapterRecord::where('id_user', $id_user)->distinct()->get(['id_module_training']);
    	$tot_finish = 0;
    	if (count($records) != null) {
    		foreach ($records as $key => $record) {
    			$rec = UserChapterRecord::where('id_user', $id_user)->where('id_module_training', $record->id_module_training)->where('is_finish', 0)->get();
    			if (count($rec) == 0) {
    				$record['status'] = 'Finished';
    				$tot_finish +=1;
    			} else {
    				$record['status'] = 'Not Finish';
    			}
    			$module_training = ModulTraining::find($record->id_module_training);
    			$record['module'] = $module_training;
    		}
    	}
    	$output['records'] = $records;
    	$output['total_finish'] = $tot_finish;

    	return $output;
    }
}
