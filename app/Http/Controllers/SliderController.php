<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{
    
    public function get_all_slider () {
    	$sliders = new Slider();
    	$sliders = $sliders->get_all_slider();

    	echo $sliders;
    }

    public function get_active_slider () {
    	$sliders = new Slider();
    	$sliders = $sliders->get_active_slider();

    	echo $sliders;
    }

    public function activate_slider( $id_slider ) {
    	$slider = new Slider();
    	$slider = $slider->activate_slider($id_slider);

    	echo $slider;
    }

    public function nonactivate_slider( $id_slider ) {
    	$slider = new Slider();
    	$slider = $slider->nonactivate_slider($id_slider);

    	echo $slider;	
    }
}
