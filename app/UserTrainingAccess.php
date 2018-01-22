<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\JobFamily;
use App\ModulTraining;
use App\OsDepartment;
use App\LevelPosition;
use App\OrganizationalStructure;

class UserTrainingAccess extends Model
{
    //

    public function check_access($id_user, $id_training) {
    	$user = User::find($id_user);
    	if ($user == null) {
    		return "error : user not found";
    	}
    	$module = ModulTraining::find($id_training);
    	if ($module == null) {
    		return "error : module not found";
    	}
    	if ($module->id_parent == 1 or $module->id_parent == 2) {
    		$access['status'] = 1; 
    		$access['message'] = 'can access';
    		return $access;
    	}

    	if ($module->id_parent == 3) {
    		$job_family_training = JobFamily::find($module->id_job_family);
    		if ($job_family_training == null) {
    			return "error : job family not found";
    		}

    		$org_structure_user = OrganizationalStructure::where('id_user',$user->id)->first();
    		if ($org_structure_user == null) {
    			return "error : organizational structur user not found";
    		}
    		$job_family_user = JobFamily::find($org_structure_user->id_job_family);
    		if ($job_family_user == null) {
    			return "error : job family user not found";
    		}

    		if ($job_family_user->id == $job_family_training->id) {
    			$access['status'] = 1; 
	    		$access['message'] = 'can access';
	    		return $access;
    		} else {
    			$access = UserTrainingAccess::where('id_module',$id_training)->where('id_user',$id_user)->first();
    			if ($access == null) {
	    			$access['status'] = 0; 
		    		$access['message'] = 'can not access';
		    		return $access;
	    		} else {
	    			if ($access->status == 1) {
	    				$access['status'] = 1; 
			    		$access['message'] = 'can access';
			    		return $access;
	    			} else {
	    				$access['status'] = 2; 
			    		$access['message'] = 'access requested';
			    		return $access;
	    			}
	    		}	
    		}

    	}

    	if ($module->id_parent == 4) {
    		$level_position_user = LevelPosition::find($user->position);
    		if ($level_position_user->id > 5) {
    			$access['status'] = 1; 
	    		$access['message'] = 'can access';
	    		return $access;
    		} else {
    			$access = UserTrainingAccess::where('id_module',$id_training)->where('id_user',$id_user)->first();
    			if ($access == null) {
	    			$access['status'] = 0; 
		    		$access['message'] = 'can not access';
		    		return $access;
	    		} else {
	    			if ($access->status == 1) {
	    				$access['status'] = 1; 
			    		$access['message'] = 'can access';
			    		return $access;
	    			} else {
	    				$access['status'] = 2; 
			    		$access['message'] = 'access requested';
			    		return $access;
	    			}
	    		}
    		}
    	}
    	if ($module->id_parent == 5) {
    		$access = UserTrainingAccess::where('id_module',$id_training)->where('id_user',$id_user)->first();
    		if ($access == null) {
    			$access['status'] = 0; 
	    		$access['message'] = 'can not access';
	    		return $access;
    		} else {
    			if ($access->status == 1) {
    				$access['status'] = 1; 
		    		$access['message'] = 'can access';
		    		return $access;
    			} else {
    				$access['status'] = 2; 
		    		$access['message'] = 'access requested';
		    		return $access;
    			}
    		}
    	}
    }
}
