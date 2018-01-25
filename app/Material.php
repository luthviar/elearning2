<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    
    // mendapatkan material pada chapter
    public function get_material ( $id_chapter ) {
		$material = Material::where('id_chapter', $id_chapter)->first();;
		if ( $material == null) {
			$material['status'] = 'error_material';
			$material['message'] = 'error: No Material Found';
			return $material;
		}
		$file_materials = FilesMaterial::where( "id_material" , $material->id )->get();

		if ( count($file_materials) == 0 ) {
			$material['status'] = 'error-file';
			$material['message'] = 'File Material Not Found, Please Upload The File Again.';
			return $material;
		}

		$material["files_material"] = $file_materials;
		$material['status'] = 'success';

		return $material;
	    	
    }

    // mendapatkan material pada chapter
    public function get_material_admin ( $id_chapter ) {
		
		$material = Material::where('id_chapter', $id_chapter)->first();;
		if ( $material == null) {
			$material['status'] = 'error';
			$material['message'] = 'error: no material found';
			return $material;
		}
		$material["files_material"] = FilesMaterial::where( "id_material" , $material->id )->get();
		$material['status'] = 'success';

		return $material;
	    	
    }
}
