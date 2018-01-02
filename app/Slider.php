<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    
    public function get_all_slider () {
    	$sliders = Slider::all();
    	if ( count($sliders) == 0 ) {
    		return "no slider found";
    	}
    	return $sliders;
    }

    public function get_active_slider () {
    	$sliders = Slider::where( 'flag_active' , 1)->get();
    	if ( count($sliders) == 0 ) {
    		return "no slider found";
    	}
    	return $sliders;
    }

    public function activate_slider( $id_slider ) {

    	$slider = Slider::find($id_slider);
    	if ( $slider == null ) {
    		return "slider not found";
    	}
    	if ( $slider->flag_active == 1) {
    		return "error : slider sudah aktif";
    	}
    	$slider->flag_active = 1;
    	$slider->save();

    	return "slider berhasil diaktifkan";

    }

    public function nonactivate_slider( $id_slider ) {
		$slider = Slider::find($id_slider);
    	if ( $slider == null ) {
    		return "slider not found";
    	}
    	if ( $slider->flag_active == 0) {
    		return "error : slider sudah tidak aktif";
    	}
    	$slider->flag_active = 0;
    	$slider->save();

    	return "slider berhasil dinonaktifkan";    	
    }

}
