<?php

namespace App\Http\Controllers;

use App\ForumAttachment;
use App\ForumComment;
use App\ForumCommentAttachment;
use App\JobFamily;
use App\OrganizationalStructure;
use App\OsDepartment;
use App\OsUnit;
use Illuminate\Http\Request;
use App\Forum;
use App\ModulTraining;
use App\User;
use App\AerofoodLink;
use DB;
use Auth;
use Carbon\Carbon;
use Session;

class ForumController extends Controller
{

    // MIDDLEWARE
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isAdmin', ['except' => [
             'index', 'get_all_forum', 'storeByUser', 'editByUser', 'updateByUser','get_user_forum', 'forum_public','get_forum','storeCommentByUser','comment_delete','editCommentByUser'
        ]]);
        
    }

    public function index() {
        //user information
        $id_user = Auth::user()->id;
        $user = User::where('id',$id_user)->first();

        $struktur = OrganizationalStructure::where('id_user',$user->id)->first();
        $unit = null;
        $department = null;
        $job_family = null;
        if (!empty($struktur)) {
            $unit = OsUnit::where('id', $struktur->id_unit)->first();
            $department = OsDepartment::where('id', $struktur->id_department)->first();
            $job_family = JobFamily::find($department->id_job_family);
        }
        $forum_umum = Forum::where('category', 0)->where('id_department', null)
            ->where('id_unit', null)->where('id_job_family', null)->get();
        foreach ($forum_umum as $key => $value) {
            $value['personnel'] = User::where('id',$value->created_by)->first();
            $value['replie'] = ForumComment::where('id_forum',$value->id)->get();
            if(empty($value['replie'][0])){
                $value['last_reply'] = null;
            }else{
                $value['last_reply'] = DB::table('forum_comments')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
                $value['last_reply_personnel'] = User::where('id', $value['last_reply'][0]->id)->first();
            }
        }
        $forum_unit = null;
        $forum_job_family = null;
        if ($unit != null) {
            $forum_unit = Forum::where('id_unit',$unit->id)->where('category',2)->get();
            foreach ($forum_unit as $key => $value) {
                $value['personnel'] = User::where('id',$value->created_by)->first();
                $value['replie'] = ForumComment::where('id_forum',$value->id)->get();
                if(empty($value['replie'][0])){
                    $value['last_reply'] = null;
                }else{
                    $value['last_reply'] = DB::table('forum_comments')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();
                    $value['last_reply_personnel'] = User::where('id', $value['last_reply'][0]->id)->first();
                }
            }

            $forum_job_family = Forum::where('id_job_family',$job_family->id)->where('category',1)->get();
            foreach ($forum_job_family as $key => $value) {
                $value['personnel'] = User::where('id',$value->created_by)->first();
                $value['replie'] = ForumComment::where('id_forum',$value->id)->get();
                if(empty($value['replie'][0])){
                    $value['last_reply'] = null;
                }else{
                    $value['last_reply'] = DB::table('forum_comments')->where('id_forum',$value->id)->orderBy('id', 'desc')->take(1)->get();

                    $value['last_reply_personnel'] = User::where('id', $value['last_reply'][0]->id)->first();

                }
            }
        }
//        dd($forum_job_family);
//        $module = Module::all();
        return view('user.forum.index')
            ->with('forum_umum', $forum_umum)
            ->with('forum_unit',$forum_unit)
            ->with('department',$department)
            ->with('forum_job_family',$forum_job_family)
            ->with('unit',$unit)
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

//        dd($request->id_unit);
        if ($request->id_unit != null) {
            if(empty($request->content3)) {
                Session::flash('failed', 'Field content thread FORUM UNIT wajib diisi.');
                return redirect()->back();
            }
            $content = $request->content3;
            $category = 2;
        }elseif($request->id_job_family != null){
            if(empty($request->content2)) {
                Session::flash('failed', 'Field content thread FORUM JOB FAMILY wajib diisi.');
                return redirect()->back();
            }
            $content = $request->content2;
            $category = 1;
        }else{
            if(empty($request->content)) {
                Session::flash('failed', 'Field content thread FORUM UMUM wajib diisi.');
                return redirect()->back();
            }
            $content = $request->content;
            $category = 0;
        }

        $id_forum = DB::table('forums')-> insertGetId(array(
            'created_by' => $id_user,
            'title' => $request->title,
            'content' => $content,
            'is_reply' => $request->can_reply,
            'id_unit' => $request->id_unit,
            'id_department' => $request->id_department,
            'id_job_family' => $request->id_job_family,
            'category' => $category,
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

    public function deleteAttachmentByUser($id) {
        $file = ForumAttachment::find($id);

        if (empty($file)) {
            return 'error: file not found';
        }

        DB::table('forum_attachments')->where('id','=',$id)->delete();

        Session::flash('success', 'Attachment Anda berhasil dihapus.');

        return \Redirect::back();
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

        $forum = Forum::find($request->id_forum);
        Session::flash('success', 'Thread Anda berhasil di-UPDATE.');
        return redirect(url(action('ForumController@get_forum',$forum->id)));
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
        $link = AerofoodLink::all();
//        $module = Module::all();
//        dd($forum);
        return view('user.forum.view')
            ->with('forum',$forum)->with('recent',$recent)->with('link',$link);


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

        Session::flash('success', 'Comment Anda berhasil di-posting.');
        return redirect()->action(
            'ForumController@get_forum', ['id' => $request->id_forum]
        );
    }


    public function comment_delete($id_forum_comment) {
        $comment = ForumComment::find($id_forum_comment);

        if (empty($comment)) {
            return 'error: comment not found';
        }

        DB::table('forum_comments')->where('id','=',$id_forum_comment)->delete();
        DB::table('forum_comment_attachments')->where('id_comment','=',$id_forum_comment)->delete();

        Session::flash('success', 'Comment Anda berhasil dihapus.');

        return \Redirect::back();
    }

    public function editCommentByUser($id_forum_comment) {
        $comment = ForumComment::find($id_forum_comment);
        $comment['file_pendukung'] = ForumCommentAttachment::where('id_comment', $id_forum_comment)->get();

        return view('user.forum.edit_comment')
            ->with('forum',$comment);
    }

    public function updateCommentByuser(Request $request) {
        $forum = ForumComment::find($request->id_forum);

        $this -> validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $file = $request->file('image');
        if (empty($file)) {
            $forum = ForumComment::find($request->id_forum);
            $forum->title = $request->title;
            $forum->content = $request->content;
            $forum->save();

            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath = 'Uploads';
                    $movea = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung = new ForumCommentAttachment();
                    $new_file_pendukung->id_comment = $request->id_forum;
                    $new_file_pendukung->attachment_name = $file->getClientOriginalName();
                    $new_file_pendukung->attachment_url = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }else{
            $destinationPath = 'uploads';
            $movea = $file->move($destinationPath,$file->getClientOriginalName());
            $url = "uploads/{$file->getClientOriginalName()}";

            $forum = ForumComment::find($request->id_forum);
            $forum->title = $request->title;
            $forum->content = $request->content;
            $forum->image = $url;
            $forum->save();

            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath = 'Uploads';
                    $movea = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung = new ForumCommentAttachment();
                    $new_file_pendukung->id_comment = $request->id_forum;
                    $new_file_pendukung->attachment_name = $file->getClientOriginalName();
                    $new_file_pendukung->attachment_url = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }


        Session::flash('success', 'Comment Anda berhasil di-UPDATE.');
        return redirect(url(action('ForumController@get_forum',$forum->id_forum)));
    }

    public function deleteAttachmentCommentByUser($id) {
        $file = ForumCommentAttachment::find($id);

        if (empty($file)) {
            return 'error: file not found';
        }

        DB::table('forum_comment_attachments')->where('id','=',$id)->delete();

        Session::flash('success', 'Attachment Anda berhasil dihapus.');

        return \Redirect::back();
    }

    // ----------------------------------------
    // ADMIN AREA
    // ----------------------------------------

    public function forum_public_list(){
        return view('admin.forum.forum_public');
    }

    public function forum_public_list_serverside(Request $request){
        $columns = array( 
                            0 =>    'title', 
                            1 =>    'created_by',
                            2 =>    'content',
                            3 =>    'created_at',
                            4 =>    'id'
                            
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
                $nestedData['title'] =
                    "<a href='".url(action('ForumController@forum_admin_view',$forum->id))."'>"
                    .$forum->title."</a>";

                $user = new User();
                $user = $user->get_user($forum->created_by);
                if ($user['status'] == 'error') {
                    return "";
                }
                $nestedData['created_by'] = $user->name;
                $nestedData['snippet'] = substr(strip_tags($forum->content),0,50)."...";
                $nestedData['created_at'] = date('j M Y',strtotime($forum->created_at));
                $nestedData['delete'] = "<a href='".url('admin/forum/delete',$forum->id)."' class='btn btn-warning'>Delete</a>";



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
        return view('admin.forum.forum_job_family');
    }

    public function forum_job_family_list_serverside(Request $request){
        $columns = array( 
                            0 =>    'title', 
                            1 =>    'created_by',
                            2 =>    'content',
                            3 =>    'id_job_family',
                            4 =>    'created_at',
                            5 =>    'id'
                            
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

                $nestedData['title'] =
                    "<a href='".url(action('ForumController@forum_admin_view',$forum->id))."'>"
                    .$forum->title."</a>";

                $user = new User();
                $user = $user->get_user($forum->created_by);
                if ($user['status'] == 'error') {
                    return "";
                }
                $nestedData['created_by'] = $user->name;
                $nestedData['snippet'] = substr(strip_tags($forum->content),0,50)."...";
                $job_family = JobFamily::find($forum->id_job_family);
                $nestedData['job_family'] = $job_family->job_family_name;
                $nestedData['created_at'] = date('j M Y',strtotime($forum->created_at));
                $nestedData['delete'] = "<a href='".url('admin/forum/delete',$forum->id)."' class='btn btn-warning'>Delete</a>";

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


    public function forum_unit_list(){
        return view('admin.forum.forum_unit');
    }

    public function forum_unit_list_serverside(Request $request){
        $columns = array( 
                            0 =>    'title', 
                            1 =>    'created_by',
                            2 =>    'content',
                            3 =>    'id_unit',
                            4 =>    'created_at',
                            5 =>    'id'
                            
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

                $nestedData['title'] =
                    "<a href='".url(action('ForumController@forum_admin_view',$forum->id))."'>"
                    .$forum->title."</a>";

                $user = new User();
                $user = $user->get_user($forum->created_by);

                if ($user['status'] == 'error') {
                    return "";
                }
                $nestedData['created_by'] = $user->name;
                $nestedData['snippet'] = substr(strip_tags($forum->content),0,50)."...";
                $unit = OsUnit::find($forum->id_unit);
                $nestedData['unit'] = $unit->unit_name;
                $nestedData['created_at'] = date('j M Y',strtotime($forum->created_at));
                $nestedData['delete'] = "<a href='".url('admin/forum/delete',$forum->id)."' class='btn btn-warning'>Delete</a>";

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
        return view('admin.forum.forum_view')->with('forum', $forum);
    }

    public function forum_remove ($id_forum){
        $forum = Forum::find($id_forum);
        if ($forum == null) {
            return 'error: forum not found';
        }
        DB::table('forums')->where('id','=',$id_forum)->delete();

        return \Redirect::back();
    }



}
