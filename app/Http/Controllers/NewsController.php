<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\ModulTraining;
use App\User;

class NewsController extends Controller
{

    public function index(){
//        $news = new News();
//        $news = $news->get_all_news();

        $news = new News();
        $news = $news->get_all_active_news();

        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        return view('user.newsboard')->with('newses', $news)->with('module',$modul);

//        return view('user.newsboard')->with('newses',$news);
    }

    public function viewnews(){
        return view('user.news.view_news');
    }

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

    	return view('user.news.view_news')
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


    // -------------------------------------
    //          ADMIN PAGE
    // -------------------------------------


    public function news_list(){
        return view('admin.news');
    }

    public function news_list_serverside(Request $request){
        $columns = array( 
                            0 =>'title', 
                            1 =>'created_by',
                            2 => 'content',
                            3 => 'created_at',
                            4 => 'is_publish',
                        );
  
        $totalData = News::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {   
            $news = News::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $news =  News::where('title','LIKE',"%{$search}%")
                            ->orWhere('content', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = News::where('content','LIKE',"%{$search}%")
                             ->orWhere('title', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($news))
        {
            foreach ($news as $det_news)
            {

                $nestedData['title'] = "<a href='".url('/admin_news',$det_news->id)."'>".$det_news->title."</a>";

                $user = new User();
                $user = $user->get_user($det_news->created_by);
                if ($user['status'] == 'error') {
                    return "";
                }
                $nestedData['created_by'] = $user->name;
                $nestedData['snippet'] = substr(strip_tags($det_news->content),0,50)."...";
                $nestedData['created_at'] = date('j M Y',strtotime($det_news->created_at));
                if ($det_news->is_publish == 1) {
                    $nestedData['is_publish'] = "published";
                } else {
                    $nestedData['is_publish'] = "not published";
                }
                
                
                
                $data[] = $nestedData;

            }
        }
          
        $json_data = array(
                    "draw"            => intval($request->input('draw')),  
                    "recordsTotal"    => intval($totalData),  
                    "recordsFiltered" => intval($totalFiltered), 
                    "data"            => $data   
                    );
            
        echo json_encode($json_data); 
    }
}
