<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use App\ModulTraining;
use Auth;

class ForumController extends Controller
{
    public function index() {
        //user information
//        $id_user = Auth::user()->id;
//        $personnel = Personnel::where('id_user',$id_user)->first();
//        $employee = Employee::where('id_personnel',$personnel->id)->first();
//        $struktur = StrukturOrganisasi::find($employee->struktur);
//        $department = null;
//        $job_family = null;
//        if (!empty($struktur)) {
//            $department = Department::where('id_department', $struktur->id_department)->first();
//            $job_family = JobFamily::find($department->id_job_family);
//        }
//        $forum_umum = Forum::where('id_department', null)->where('id_job_family', null)->get();
//        foreach ($forum_umum as $key => $value) {
//            $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
//            $value['replie'] = Replie::where('id_forum',$value->id)->get();
//            if(empty($value['replie'][0])){
//                $value['last_reply'] = null;
//            }else{
//                $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
//                $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();
//            }
//        }
//        $forum_department = null;
//        $forum_job_family = null;
//        if ($department != null) {
//            $forum_department = Forum::where('id_department',$department->id_department)->get();
//            foreach ($forum_department as $key => $value) {
//                $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
//                $value['replie'] = Replie::where('id_forum',$value->id)->get();
//                if(empty($value['replie'][0])){
//                    $value['last_reply'] = null;
//                }else{
//                    $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
//                    $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();
//                }
//            }
//
//            $forum_job_family = Forum::where('id_job_family',$department->id_job_family)->get();
//            foreach ($forum_job_family as $key => $value) {
//                $value['personnel'] = Personnel::where('id_user',$value->id_user)->first();
//                $value['replie'] = Replie::where('id_forum',$value->id)->get();
//                if(empty($value['replie'][0])){
//                    $value['last_reply'] = null;
//                }else{
//                    $value['last_reply'] = DB::table('replies')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
//
//                    $value['last_reply_personnel'] = Personnel::where('id_user', $value['last_reply'][0]->id_user)->first();
//
//                }
//            }
//        }

//        $module = Module::all();
        return view('user.forum');
//            ->with('module',$module)
//            ->with('forum_umum', $forum_umum)
//            ->with('forum_department',$forum_department)
//            ->with('forum_job_family',$forum_job_family)
//            ->with('department',$department)
//            ->with('job_family',$job_family);

    }

    public function get_all_forum () {
    	$forum = new Forum();
    	$forum = $forum->get_all_forum();

    	echo $forum;
    }

    public function get_forum ( $id_forum ) {
    	$forum = new Forum();
    	$forum = $forum->get_forum( $id_forum );

    	echo $forum;
    }

    public function get_user_forum ( $forum_type ) {
        $forum = new Forum();

        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        if ( $forum_type == 'public') {
            $forums = $forum->get_forum_public();
            return view('forums_public')
                        ->with('forums', $forums)
                        ->with('module', $modul);

        } elseif ( $forum_type == 'job_family' ) {
            # code...
        } elseif ( $forum_type == 'department') {
            # code...
        } else {
            echo "error";
        }
    }

    public function forum_public (Request $request) {
        $columns = array( 
                            0 =>'title', 
                            1 =>'created_by',
                            2=> 'comments',
                            3=> 'last_seen',
                        );
  
        $totalData = Forum::where('category',0)->count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {            
            $forum_model = new Forum();
            $forums = $forum_model->get_forum_public_server_side($limit, $start, $order, $dir);
            // $forums = Forum::offset($start)
            //              ->limit($limit)
            //              ->orderBy($order,$dir)
            //              ->get();
        } else {
            $search = $request->input('search.value'); 

            $forums =  Forum::where('title','LIKE',"%{$search}%")
                            //->orWhere('title', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Forum::where('title','LIKE',"%{$search}%")
                             //->orWhere('title', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($forums))
        {
            foreach ($forums as $forum)
            {

                $nestedData['title'] = $forum->title;
                $nestedData['created_by'] = $forum['user']->name . "<br>" . date('j M Y h:i a',strtotime($forum->created_at));
                $nestedData['comments'] = $forum['comments_count'];
                if ($forum['last_seen'] == null) {
                    $nestedData['last_seen'] = 'no activity';
                } else {
                    $nestedData['last_seen'] = $forum['last_seen']['user']->name . "<br>" . date('j M Y h:i a',strtotime($forum['last_seen']->created_at));
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
