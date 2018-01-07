<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    
    // mendapatkan material pada chapter
    public function get_material ( $id_chapter ) {
		
		function getFileMaterial ( $material ) {
			$file_materials = FilesMaterial::where( "id_material" , $material->id )->get();
			if ( $file_materials == null ) {
				return "";
			} else {
				return $file_materials;
			}
		}

		$material = Material::where('id_chapter', $id_chapter)->first();;
		if ( $material == null) {
			$material['status'] = 'error';
			$material['message'] = 'error: no material found';
			return $material;
		}
		$material["files_material"] = getFileMaterial( $material );
		$material['status'] = 'success';

		return $material;
	    	
    }

    // mendapatkan material pada chapter
    public function get_material_admin ( $id_chapter ) {
		
		function getFileMaterial ( $material ) {
			$file_materials = FilesMaterial::where( "id_material" , $material->id )->get();
			return $file_materials;
		}

		$material = Material::where('id_chapter', $id_chapter)->first();;
		if ( $material == null) {
			$material['status'] = 'error';
			$material['message'] = 'error: no material found';
			return $material;
		}
		$material["files_material"] = getFileMaterial( $material );
		$material['status'] = 'success';

		return $material;
	    	
    }
}
