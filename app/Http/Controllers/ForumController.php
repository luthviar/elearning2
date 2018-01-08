<?php

namespace App\Http\Controllers;

use App\ForumAttachment;
use App\ForumComment;
use App\ForumCommentAttachment;
use App\OrganizationalStructure;
use Illuminate\Http\Request;
use App\Forum;
use App\ModulTraining;
use App\User;
use DB;
use Auth;
use Carbon\Carbon;

class ForumController extends Controller
{
    public function index() {
        //user information
        $id_user = Auth::user()->id;
        $user = User::where('id',$id_user)->first();

        $struktur = OrganizationalStructure::find($user->id_organizational_structure);
        $department = null;
        $job_family = null;
        if (!empty($struktur)) {
            $department = Department::where('id_department', $struktur->id_department)->first();
            $job_family = JobFamily::find($department->id_job_family);
        }
        $forum_umum = Forum::where('id_department', null)->where('id_job_family', null)->get();
        foreach ($forum_umum as $key => $value) {
            $value['personnel'] = User::where('id',$value->id_user)->first();
            $value['replie'] = ForumComment::where('id_forum',$value->id)->get();
            if(empty($value['replie'][0])){
                $value['last_reply'] = null;
            }else{
                $value['last_reply'] = DB::table('forum_comments')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
                $value['last_reply_personnel'] = User::where('id', $value['last_reply'][0]->id)->first();
            }
        }
        $forum_department = null;
        $forum_job_family = null;
        if ($department != null) {
            $forum_department = Forum::where('id_department',$department->id_department)->get();
            foreach ($forum_department as $key => $value) {
                $value['personnel'] = User::where('id_user',$value->id_user)->first();
                $value['replie'] = ForumComment::where('id_forum',$value->id)->get();
                if(empty($value['replie'][0])){
                    $value['last_reply'] = null;
                }else{
                    $value['last_reply'] = DB::table('forum_comments')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
                    $value['last_reply_personnel'] = User::where('id', $value['last_reply'][0]->id)->first();
                }
            }

            $forum_job_family = Forum::where('id_job_family',$department->id_job_family)->get();
            foreach ($forum_job_family as $key => $value) {
                $value['personnel'] = User::where('id_user',$value->id_user)->first();
                $value['replie'] = ForumComment::where('id_forum',$value->id)->get();
                if(empty($value['replie'][0])){
                    $value['last_reply'] = null;
                }else{
                    $value['last_reply'] = DB::table('forum_comments')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();

                    $value['last_reply_personnel'] = User::where('id', $value['last_reply'][0]->id)->first();

                }
            }
        }

//        $module = Module::all();
        return view('user.forum.index')
            ->with('forum_umum', $forum_umum)
            ->with('forum_department',$forum_department)
            ->with('forum_job_family',$forum_job_family)
            ->with('department',$department)
            ->with('job_family',$job_family);

    }

    public function get_all_forum () {
    	$forum = new Forum();
    	$forum = $forum->get_all_forum();

    	echo $forum;
    }

    public function storeByUser(Request $request)
    {
        $id_user = Auth::user()->id;

        $content = "";
//        dd('masuk');
        if ($request->id_department != null) {
            $content = $request->content3;
        }elseif($request->id_job_family != null){
            $content = $request->content2;
        }else{
            $content = $request->content;
        }

        $id_forum = DB::table('forums')-> insertGetId(array(
            'created_by' => $id_user,
            'title' => $request->title,
            'content' => $content,
            'is_reply' => $request->can_reply,
            'id_department' => $request->id_department,
            'id_job_family' => $request->id_job_family,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ));

        $file_pendukung = $request->file('file_pendukung');
        if (!empty($file_pendukung)) {

            foreach ($file_pendukung as $key => $file) {
                $destinationPath = 'Uploads';
                $movea = $file->move($destinationPath,$file->getClientOriginalName());
                $url_file = "Uploads/{$file->getClientOriginalName()}";

                $new_file_pendukung = new ForumAttachment;
                $new_file_pendukung->id_forum = $id_forum;
                $new_file_pendukung->attachment_name = $file->getClientOriginalName();
                $new_file_pendukung->attachment_url = $url_file;
                $new_file_pendukung->save();
            }
        }

        return redirect('forum');
    }

    public function editByUser($id_forum) {
        $forum = Forum::find($id_forum);
        $forum['file_pendukung'] = ForumAttachment::where('id_forum', $id_forum)->get();

        return view('user.forum.edit')
            ->with('forum',$forum);
    }

    public function updateByUser(Request $request) {
        $this -> validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $file = $request->file('image');
        if (empty($file)) {
            $forum = Forum::find($request->id_forum);
            $forum->title = $request->title;
            $forum->content = $request->content;
            $forum->is_reply = $request->can_reply;
            $forum->save();

            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath = 'Uploads';
                    $movea = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung = new ForumAttachment;
                    $new_file_pendukung->id_forum = $request->id_forum;
                    $new_file_pendukung->attachment_name = $file->getClientOriginalName();
                    $new_file_pendukung->attachment_url = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }else{
            $destinationPath = 'uploads';
            $movea = $file->move($destinationPath,$file->getClientOriginalName());
            $url = "uploads/{$file->getClientOriginalName()}";

            $forum = Forum::find($request->id_forum);
            $forum->title = $request->title;
            $forum->content = $request->content;
            $forum->is_reply = $request->can_reply;
            $forum->image = $url;
            $forum->save();

            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath = 'Uploads';
                    $movea = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung = new ForumAttachment;
                    $new_file_pendukung->id_forum = $request->id_forum;
                    $new_file_pendukung->attachment_name = $file->getClientOriginalName();
                    $new_file_pendukung->attachment_url = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }


        return redirect('forum');
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

    public function get_forum ( $id_forum ) {
        //get modul training
//        $modul = new ModulTraining();
//        $modul = $modul->get_module_training();
//
//
//        $forums = new Forum();
//        $forum = $forums->get_forum($id_forum);
//        if ($forum['status'] == 'error') {
//            return view('user.error')->with('error', $forum)->with('module',$modul);
//        }
//        $last_six = $forums->get_last_six_forum();

//

        $forum = Forum::find($id_forum);
        if (empty($forum)) {
            return view('404');
        }
        $forum['personnel'] = User::where('id',$forum->created_by)->first();
        $forum['replie'] = ForumComment::where('id_forum',$id_forum)->get();
        foreach ($forum['replie'] as $key => $value) {
            $value['personnel'] = User::where('id',$value->created_by)->first();
            $value['file_pendukung'] = ForumCommentAttachment::where('id_comment', $value->id)->get();
        }
        $recent = DB::table('forums')
            ->where('id_department',$forum->id_department)
            ->where('id_job_family',$forum->id_job_family)
            ->orderBy('id', 'desc')->take(6)->get();

        $forum['file_pendukung'] = ForumAttachment::where('id_forum', $id_forum)->get();
//        $module = Module::all();
//        dd($forum);
        return view('user.forum.view')
            ->with('forum',$forum)->with('recent',$recent);


//        return view('user.forum.view')->with('forum', $forum)->with('last_six',$last_six);
    }

    public function storeCommentByUser(Request $request)
    {
        $id_reply = DB::table('forum_comments')-> insertGetId(array(
            'created_by' => $request->id_user,
            'id_forum' => $request->id_forum,
            'title' => $request->title,
            'content' => $request->content,
        ));

        $file_pendukung = $request->file('file_pendukung');
        if (!empty($file_pendukung)) {
            foreach ($file_pendukung as $key => $file) {
                $destinationPath = 'Uploads';
                $movea = $file->move($destinationPath,$file->getClientOriginalName());
                $url_file = "Uploads/{$file->getClientOriginalName()}";

                $new_file_pendukung = new ForumCommentAttachment;
                $new_file_pendukung->id_comment = $id_reply;
                $new_file_pendukung->attachment_name = $file->getClientOriginalName();
                $new_file_pendukung->attachment_url = $url_file;
                $new_file_pendukung->created_at = Carbon::now('Asia/Jakarta');
                $new_file_pendukung->save();
            }
        }


        return redirect()->action(
            'ForumController@get_forum', ['id' => $request->id_forum]
        );
    }

    // ----------------------------------------
    // ADMIN AREA
    // ----------------------------------------

    public function forum_public_list(){
        return view('admin.forum_public');
    }

    public function forum_public_list_serverside(Request $request){
        $columns = array( 
                            0 =>    'title', 
                            1 =>    'created_by',
                            2 =>    'content',
                            3 =>    'created_at',
                            
                        );
  
        $totalData = Forum::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {   
            $forums = Forum::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->where('category',0)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $forums =  DB::table('forums')
                            ->where('forums.category','=',0)
                            ->where(function($query) use ($search){
                                $query->where('forums.content', 'LIKE',"%{$search}%");
                                $query->orWhere('forums.title','LIKE',"%{$search}%");
                            })
                            ->orderBy($order,$dir)
                            ->limit($limit)
                            ->offset($start)
                            ->get();

            $totalFiltered = DB::table('forums')
                             ->where('forums.category','=',0)
                             ->where(function($query) use ($search){
                                $query->where('forums.content', 'LIKE',"%{$search}%");
                                $query->orWhere('forums.title','LIKE',"%{$search}%");
                             })
                             ->count();
        }

        $data = array();
        if(!empty($forums))
        {
            foreach ($forums as $forum)
            {

                $nestedData['title'] = "<a href='".url('/admin_forum',$forum->id)."'>".$forum->title."</a>";

                $user = new User();
                $user = $user->get_user($forum->created_by);
                if ($user['status'] == 'error') {
                    return "";
                }
                $nestedData['created_by'] = $user->name;
                $nestedData['snippet'] = substr(strip_tags($forum->content),0,50)."...";
                $nestedData['created_at'] = date('j M Y',strtotime($forum->created_at));
                
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


    public function forum_job_family_list(){
        return view('admin.forum_job_family');
    }

    public function forum_job_family_list_serverside(Request $request){
        $columns = array( 
                            0 =>    'title', 
                            1 =>    'created_by',
                            2 =>    'content',
                            3 =>    'id_job_family',
                            4 =>    'created_at',
                            
                        );
  
        $totalData = Forum::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {   
            $forums = Forum::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->where('category',1)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $forums =  DB::table('forums')
                            ->where('forums.category','=',1)
                            ->where(function($query) use ($search){
                                $query->where('forums.content', 'LIKE',"%{$search}%");
                                $query->orWhere('forums.title','LIKE',"%{$search}%");
                            })
                            ->orderBy($order,$dir)
                            ->limit($limit)
                            ->offset($start)
                            ->get();

            $totalFiltered = DB::table('forums')
                             ->where('forums.category','=',1)
                             ->where(function($query) use ($search){
                                $query->where('forums.content', 'LIKE',"%{$search}%");
                                $query->orWhere('forums.title','LIKE',"%{$search}%");
                             })
                             ->count();
        }

        $data = array();
        if(!empty($forums))
        {
            foreach ($forums as $forum)
            {

                $nestedData['title'] = "<a href='".url('/admin_forum',$forum->id)."'>".$forum->title."</a>";

                $user = new User();
                $user = $user->get_user($forum->created_by);
                if ($user['status'] == 'error') {
                    return "";
                }
                $nestedData['created_by'] = $user->name;
                $nestedData['snippet'] = substr(strip_tags($forum->content),0,50)."...";
                $nestedData['job_family'] = $forum->id_job_family;
                $nestedData['created_at'] = date('j M Y',strtotime($forum->created_at));
                
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


    public function forum_department_list(){
        return view('admin.forum_department');
    }

    public function forum_department_list_serverside(Request $request){
        $columns = array( 
                            0 =>    'title', 
                            1 =>    'created_by',
                            2 =>    'content',
                            3 =>    'id_department',
                            4 =>    'created_at',
                            
                        );
  
        $totalData = Forum::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {   
            $forums = Forum::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->where('category',2)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $forums =  DB::table('forums')
                            ->where('forums.category','=',2)
                            ->where(function($query) use ($search){
                                $query->where('forums.content', 'LIKE',"%{$search}%");
                                $query->orWhere('forums.title','LIKE',"%{$search}%");
                            })
                            ->orderBy($order,$dir)
                            ->limit($limit)
                            ->offset($start)
                            ->get();

            $totalFiltered = DB::table('forums')
                             ->where('forums.category','=',2)
                             ->where(function($query) use ($search){
                                $query->where('forums.content', 'LIKE',"%{$search}%");
                                $query->orWhere('forums.title','LIKE',"%{$search}%");
                             })
                             ->count();
        }

        $data = array();
        if(!empty($forums))
        {
            foreach ($forums as $forum)
            {

                $nestedData['title'] = "<a href='".url('/admin_forum',$forum->id)."'>".$forum->title."</a>";

                $user = new User();
                $user = $user->get_user($forum->created_by);
                if ($user['status'] == 'error') {
                    return "";
                }
                $nestedData['created_by'] = $user->name;
                $nestedData['snippet'] = substr(strip_tags($forum->content),0,50)."...";
                $nestedData['department'] = $forum->id_department;
                $nestedData['created_at'] = date('j M Y',strtotime($forum->created_at));
                
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

    public function forum_admin_view ( $id_forum ) {
        $forum = new Forum();
        $forum = $forum->get_forum($id_forum);
        if ($forum['status'] == 'error') {
            echo $forum['message'];
        }
        return view('admin.forum_view')->with('forum', $forum);
    }
}
