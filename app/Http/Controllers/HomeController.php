<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Slider;
use App\ModulTraining;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get 6 news
        $news = new News();
        $news = $news->get_active_news();

        //get active sliders
        $sliders = new Slider();
        $sliders = $sliders->get_active_slider();

        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        return view('home')
                    ->with( 'newses' , $news )
                    ->with( 'sliders' , $sliders )
                    ->with( 'module' , $modul );
    }

    public function test(){
        //get 6 news
        $news = new News();
        $news = $news->get_active_news();

        //get active sliders
        $sliders = new Slider();
        $sliders = $sliders->get_active_slider();

        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        return view('material')
                    ->with( 'newses' , $news )
                    ->with( 'sliders' , $sliders )
                    ->with( 'module' , $modul );   
    }


}
