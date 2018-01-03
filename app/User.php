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

    public function get_user_profile (){
        function get_personal_data(){
            $data = \Auth::user();
            return $data;
        }

        function get_employee_data () {
            $data['employee_status'] = EmployeeStatus::find(\Auth::user()->id_employee_status);
            $org_structure = OrganizationalStructure::find(\Auth::user()->position);
            if ($org_structure != null) {
                if ($org_structure->id_department != null) {
                    $data['department'] = OsDepartment::find($org_structure->id_department);
                } else {
                    $data['department'] = null;
                }
                if ($org_structure->id_unit != null) {
                    $data['unit'] = OsUnit::find($org_structure->id_unit);
                }else{
                    $data['unit'] = null;
                }
                if ($org_structure->id_section != null) {
                    $data['section'] = OsSection::find($org_structure->id_section);
                } else {
                    $data['section'] = null;
                }
                if ($org_structure->id_division != null) {
                    $data['division'] = OsDivision::find($org_structure->id_division);
                } else {
                    $data['division'] = null;
                }
            }
            
            
            return $data;
        }

        $user['personal_data'] = get_personal_data();
        $user['employee_data'] = get_employee_data();

        return $user;
    }
}
