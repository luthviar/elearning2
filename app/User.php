<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\OsDivision;
use App\OsSection;
use App\OsDepartment;
use App\OsUnit;
use App\OrganizationalStructure;
use App\EmployeeStatus;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->role;
    }

    public function get_user($id_user){
        $user = User::find($id_user);
        if ($user == null) {
            $user['status'] ='error';
            $user['message'] ='error : user not found';
            return $user;
        }
        $user['status'] ='success';
        return $user;
    }

    public function get_user_profile (){
        $user['personal_data'] = \Auth::user();
        // employee data
        $data['employee_status'] = EmployeeStatus::find(\Auth::user()->id_employee_status);
            $org_structure = OrganizationalStructure::where('id_user',\Auth::user()->id)->first();
            if ($org_structure != null) {
                if ($org_structure->id_department != 0) {
                    $data['department'] = OsDepartment::find($org_structure->id_department);
                } else {
                    $data['department'] = null;
                }
                if ($org_structure->id_unit != 0) {
                    $data['unit'] = OsUnit::find($org_structure->id_unit);
                }else{
                    $data['unit'] = null;
                }
                if ($org_structure->id_section != 0) {
                    $data['section'] = OsSection::find($org_structure->id_section);
                } else {
                    $data['section'] = null;
                }
                if ($org_structure->id_division != 0) {
                    $data['division'] = OsDivision::find($org_structure->id_division);
                } else {
                    $data['division'] = null;
                }
            }
        $user['employee_data'] = $data;

        return $user;
    }

    public function change_password ( $new_password) {
        $user = User::find(\Auth::user()->id);
        if ($user == null) {
            $user['status'] = 'error';
            $user['message'] = 'user not found';
            return $user;
        }
        $user->password = bcrypt($new_password);
        $user->save();

        $user['status'] = 'success';
        return $user;        
    }

    public function profile_view ($id_user){
        
        $data = User::find($id_user);
        if ($data == null) {
            $data['status'] = 'error';
            $data['message'] = 'user not found';
            return $data;
        }

        $user['personal_data'] = $data;

        

        if ($user['personal_data']['status'] == 'error') {
//            dd($user['personal_data']);
            return $user['personal_data'];
        }
        $data_user = User::find($id_user);
        $data['employee_status'] = EmployeeStatus::find($data_user->id_employee_status);
            $org_structure = OrganizationalStructure::where('id_user',$data_user->id)->first();
            if ($org_structure != null) {
                if ($org_structure->id_department != 0) {
                    $data['department'] = OsDepartment::find($org_structure->id_department);
                } else {
                    $data['department'] = null;
                }
                if ($org_structure->id_unit != 0) {
                    $data['unit'] = OsUnit::find($org_structure->id_unit);
                }else{
                    $data['unit'] = null;
                }
                if ($org_structure->id_section != 0) {
                    $data['section'] = OsSection::find($org_structure->id_section);
                } else {
                    $data['section'] = null;
                }
                if ($org_structure->id_division != 0) {
                    $data['division'] = OsDivision::find($org_structure->id_division);
                } else {
                    $data['division'] = null;
                }
                if ($org_structure->id_job_family != 0) {
                    $data['job_family'] = JobFamily::find($org_structure->id_job_family);
                } else {
                    $data['job_family'] = null;
                }
            } else {
                $data['department'] = null;
                $data['unit'] = null;
                $data['section'] = null;
                $data['division'] = null;
                $data['job_family'] = null;
            }
        $user['employee_data'] = $data;

        return $user;
    }
}
