<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\OsDepartment;
use App\OsUnit;
use App\OsSection;
use App\OsDivision;
use App\OrganizationalStructure;


class OrganizationStructureController extends Controller
{
    // MIDDLEWARE
    public function __construct()
    {
        $this->middleware('auth');
        
    }
    
    public function get_unit (Request $request) {
    	$id_division = $request->id_division;
        $structure = OrganizationalStructure::where('id_division',$id_division)->distinct()->get(['id_unit']);
        $unit = array();
        foreach ($structure as $key => $value) {
        	if ($value->id_unit == 0) {
    			$unt['id'] = 0;
    			$unt['unit_name'] = '---';
    			array_push($unit, $unt);
    		}else{
	            $new_unit = OsUnit::find($value->id_unit);
	            array_push($unit, $new_unit);
        	}
        }

        return response()->json(['units'=>$unit]);
    }

    public function get_department (Request $request) {
    	$id_division = $request->id_division;
    	$id_unit = $request->id_unit;
    	$structure = OrganizationalStructure::where('id_division',$id_division)->where('id_unit',$id_unit)->distinct()->get(['id_department']);
    	$department = array();
    	foreach ($structure as $key => $value) {
    		if ($value->id_department == 0) {
    			$deps_null['id'] = 0;
    			$deps_null['department_name'] = '---';
    			array_push($department, $deps_null);
    		}else{
    			$deps = OsDepartment::find($value->id_department);
    			array_push($department, $deps);		
    		}
    		
    	}
    	return response()->json(['departments'=>$department]);
    }

    public function get_section (Request $request) {
    	$id_division = $request->id_division;
    	$id_unit = $request->id_unit;
    	$id_department = $request->id_department;
    	$structure = OrganizationalStructure::where('id_division',$id_division)->where('id_unit',$id_unit)->where('id_department',$id_department)->distinct()->get(['id_section']);
    	$section = array();
    	foreach ($structure as $key => $value) {
    		if ($value->id_section == 0) {
    			$sec_null['id'] = 0;
    			$sec_null['section_name'] = '---';
    			array_push($section, $sec_null);
    		}else{
    			$sec = OsSection::find($value->id_section);
    			array_push($section, $sec);		
    		}
    		
    	}
    	return response()->json(['sections'=>$section]);
    }
}
