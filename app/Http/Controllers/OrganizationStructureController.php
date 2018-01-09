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
    
    public function get_unit (Request $request) {
    	$id_division = $request->id_division;
    	console.log($id_division);
        $structure = OrganizationalStructure::where('id_division',$id_division)->distinct()->get(['id_unit']);
        $unit = array();
        foreach ($structure as $key => $value) {
            $new_unit = OsUnit::find($value->id_unit);
            array_push($unit, $new_unit);
        }

        return response()->json(['units'=>$unit]);
    }
}
