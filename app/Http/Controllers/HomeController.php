<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Slider;
use DB;
use App\AerofoodLink;
use App\ModulTraining;
use Session;

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

        $schedule = ModulTraining::where('is_child',1)
                         ->whereDate('date','>=', DB::raw('CURDATE()'))
                         ->limit(6)
                         ->get();

        $link = AerofoodLink::all();

        Session::put('link',$link);
        Session::put('module',$modul);

        return view('user.home')
                    ->with( 'newses' , $news )
                    ->with( 'sliders' , $sliders )
                    ->with( 'module' , $modul )
                    ->with( 'schedule', $schedule)
                    ->with( 'link', $link);
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

        return view('profile')
                    ->with( 'newses' , $news )
                    ->with( 'sliders' , $sliders )
                    ->with( 'module' , $modul );   
    }


}
