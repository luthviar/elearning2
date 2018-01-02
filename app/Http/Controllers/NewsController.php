<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\ModulTraining;

class NewsController extends Controller
{
    
    public function get_all_news(){

    	$news = new News();
    	$news = $news->get_all_news();
    	echo $news;
    }

    public function get_active_news(){
    	$news = new News();
    	$news = $news->get_all_active_news();

        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();
    	
        return view('paginate_news')->with('newses', $news)->with('module',$modul);
    }

    public function get_news( $news_id ) {
    	$news = new News();
    	$newses = $news->get_news( $news_id );

        $last_six_news = $news->get_active_news();

        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

    	return view('news')
                    ->with( 'news' , $newses )
                    ->with( 'last_news' , $last_six_news)
                    ->with( 'module', $modul);
    }

    public function paginate_news ( Request $request ) {
        $news = new News();
        $newses = $news->get_all_active_news();

        $paginate_news = $newses::paginate(6);
        if ( $request->ajax()) {
            return view('data', compact('newses'));
        }
        return view('newses',compact('newses'));
    }

    public function activate_news( $news_id ) {
        $news = new News();
        $news = $news->activate_news($news_id);

        echo $news;
    }

    public function nonactivate_news( $news_id ) {
        $news = new News();
        $news = $news->nonactivate_news($news_id);

        echo $news;
    }
}
