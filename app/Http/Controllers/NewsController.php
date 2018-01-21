<?php

namespace App\Http\Controllers;

use App\NewsAttachment;
use App\AerofoodLink;
use App\NewsComment;
use App\NewsCommentAttachment;
use Illuminate\Http\Request;
use App\News;
use App\ModulTraining;
use App\User;
use DB;
use Carbon\Carbon;
use Session;

class NewsController extends Controller
{
    // MIDDLEWARE
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
             'index', 'viewnews','get_all_news', 'get_active_news','get_news','paginate_news','storeCommentByUser'
        ]]);
        $this->middleware('isAdmin', ['except' => [
             'index', 'viewnews','get_all_news', 'get_active_news','get_news','paginate_news','storeCommentByUser'
        ]]);
        
    }

    public function index(){
//        $news = new News();
//        $news = $news->get_all_news();

        $news = new News();
        $news = $news->get_all_active_news();

        //get modul training
        $modul = new ModulTraining();
        $modul = $modul->get_module_training();

        return view('user.news.index')->with('newses', $news)->with('module',$modul);

//        return view('user.newsboard')->with('newses',$news);
    }

    public function viewnews(){
        return view('user.news.view');
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
//    	$news = new News();
//    	$newses = $news->get_news( $news_id );
//
//        $last_six_news = $news->get_active_news();
//
//        //get modul training
//        $modul = new ModulTraining();
//        $modul = $modul->get_module_training();
//
//    	return view('user.news.view')
//                    ->with( 'news' , $newses )
//                    ->with( 'last_news' , $last_six_news)
//                    ->with( 'module', $modul);

        $berita = News::find($news_id);
        if (empty($berita)) {
            return view('404');
        }
        $berita['user'] = User::where('id',$berita->created_by)->first();
        $replies = null;
        if ($berita->is_reply == 1) {
            $replies = NewsComment::where('id_news',$news_id)->get();
            if (empty($replies)) {
                # code...
            }else{
                foreach ($replies as $key => $value) {
                    $value['user'] = User::where('id',$value->created_by)->first();
                    $value['file_pendukung'] = NewsCommentAttachment::where('id_comment', $value->id)->get();
                }
            }
        }
        $berita['file_pendukung'] = NewsAttachment::where('id_news', $news_id)->get();
        $recent = DB::table('newses')->orderBy('id', 'desc')->take(6)->get();
        $link = AerofoodLink::all();
//        $module = Module::all();
//        dd($replies);
        return view('user.news.view')->with('news',$berita)->with('replies',$replies)->with('beritas',$recent)->with('link',$link);
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

    public function storeCommentByUser(Request $request)
    {
        $id_news_reply = 0;
        if (empty($request->content)) {
            $id_news_reply = DB::table('news_comments')-> insertGetId(array(
                'id_news' => $request->id_news,
                'created_by' => $request->id_user,
                'title' => $request->title,
                'content' => "",
                'created_at' => Carbon::now('Asia/Jakarta'),
            ));
        }else{
            $id_news_reply = DB::table('news_comments')-> insertGetId(array(
                'id_news' => $request->id_news,
                'created_by' => $request->id_user,
                'title' => $request->title,
                'content' => $request->content,
                'created_at' => Carbon::now('Asia/Jakarta'),
            ));
        }


        $file_pendukung = $request->file('file_pendukung');
        if (!empty($file_pendukung)) {

            foreach ($file_pendukung as $key => $file) {
                $destinationPath = 'Uploads';
                $movea = $file->move($destinationPath,$file->getClientOriginalName());
                $url_file = "Uploads/{$file->getClientOriginalName()}";

                $new_file_pendukung = new NewsCommentAttachment;
                $new_file_pendukung->id_comment = $id_news_reply;
                $new_file_pendukung->attachment_name = $file->getClientOriginalName();
                $new_file_pendukung->attachment_url = $url_file;
                $new_file_pendukung->save();
            }
        }
        return redirect()->action(
            'NewsController@get_news', ['id' => $request->id_news]
        );
    }


    public function comment_delete($id_news_comment) {
        $comment = NewsComment::find($id_news_comment);

        if (empty($comment)) {
            return 'error: comment not found';
        }

        DB::table('news_comments')->where('id','=',$id_news_comment)->delete();
        DB::table('news_comment_attachments')->where('id_comment','=',$id_news_comment)->delete();

        Session::flash('success', 'Comment Anda berhasil dihapus.');

        return \Redirect::back();
    }

    public function editCommentByUser($id_comment) {
        $comment = NewsComment::find($id_comment);
        $comment['file_pendukung'] = NewsCommentAttachment::where('id_comment', $id_comment)->get();

        return view('user.news.edit_comment')
            ->with('forum',$comment);
    }

    public function updateCommentByuser(Request $request) {
        $forum = NewsComment::find($request->id_forum);

//        dd($forum);

        $this -> validate($request, [
            'title' => 'required',
            'content' => 'required',
        ]);

        $file = $request->file('image');
        if (empty($file)) {
            $forum = NewsComment::find($request->id_forum);
            $forum->title = $request->title;
            $forum->content = $request->content;
            $forum->save();

            $file_pendukung = $request->file('file_pendukung');
            if (!empty($file_pendukung)) {

                foreach ($file_pendukung as $key => $file) {
                    $destinationPath = 'Uploads';
                    $movea = $file->move($destinationPath,$file->getClientOriginalName());
                    $url_file = "Uploads/{$file->getClientOriginalName()}";

                    $new_file_pendukung = new NewsCommentAttachment();
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

            $forum = NewsComment::find($request->id_forum);
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

                    $new_file_pendukung = new NewsCommentAttachment();
                    $new_file_pendukung->id_comment = $request->id_forum;
                    $new_file_pendukung->attachment_name = $file->getClientOriginalName();
                    $new_file_pendukung->attachment_url = $url_file;
                    $new_file_pendukung->save();
                }
            }
        }

        $forum = NewsComment::find($request->id_forum);
        Session::flash('success', 'Comment Anda berhasil di-UPDATE.');
        return redirect(url(action('NewsController@get_news',$forum->id_news)));
    }

    public function deleteAttachmentCommentByUser($id) {
        $file = NewsCommentAttachment::find($id);

        if (empty($file)) {
            return 'error: file not found';
        }

        DB::table('news_comment_attachments')->where('id','=',$id)->delete();

        Session::flash('success', 'Attachment Anda berhasil dihapus.');

        return \Redirect::back();
    }



    // -------------------------------------
    //          ADMIN PAGE
    // -------------------------------------


    public function news_list(){
        return view('admin.news.news');
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

                $nestedData['title'] =
                    "<a href='".url(action('NewsController@admin_news_view',$det_news->id))."'>"
                    .$det_news->title."</a>";

                $user = new User();
                $user = $user->get_user($det_news->created_by);
                if ($user['status'] == 'error') {
                    return "";
                }
                $nestedData['created_by'] = $user->name;
                $nestedData['snippet'] = substr(strip_tags($det_news->content),0,50)."...";
                $nestedData['created_at'] = date('Y-M-d H:i:s',strtotime($det_news->created_at));
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

    public function admin_news_view($id_news){
        $news = new News();
        $news = $news->get_news($id_news);

        if ($news == null) {
            echo "error: news not found";
        }
        return view('admin.news.news_view')->with('news',$news);
    }

    public function news_add_submit(Request $request) {

        $image = $request->file('image');
        $url = null;
        if(empty($request->content)) {
            Session::flash('failed', 'Field content Text Area NEWS wajib diisi.');
            return redirect()->back();
        }
        if (!empty($image)) {
            $destinationPath = 'file_img';
            $movea = $image->move($destinationPath,$image->getClientOriginalName());
            $url = "file_img/{$image->getClientOriginalName()}";
        }
        
        $id = DB::table('newses')->insertGetId(
            [
            'title'         => $request->title, 
            'created_by'    => \Auth::user()->id,
            'content'       => $request->content,
            'is_publish'    => 0,
            'flag_active'   => 1,
            'url_image'     => $url,
            'is_reply'     => $request->can_reply,
            ]
        );

        $files = $request->file('attachment');
        if (!empty($files)) {
            foreach ($files as $key => $file) {
                $destinationPath = 'file_attachment';
                $movea = $file->move($destinationPath,$file->getClientOriginalName());
                $url = "file_attachment/{$file->getClientOriginalName()}";

                $attachment = new NewsAttachment;
                $attachment->id_news = $id;
                $attachment->attachment_name = $file->getClientOriginalName();
                $attachment->attachment_url = $url;
                $attachment->save();
            }
        }
        Session::flash('success',
            'Anda berhasil menambahkan NEWS baru, silahkan PUBLISH news tersebut agar tampil pada halaman utama. PUBLISH dapat dilakukan pada tombol berikut: ');
        Session::flash('success-news', $id);

        return redirect(action('NewsController@news_list'));
    }

    public function news_edit($id_news){
        $news = News::find($id_news);
        if ($news == null) {
            return 'error : news not found';
        }
        $news['attachments'] = NewsAttachment::where('id_news', $id_news)->get();
        return view('admin.news.news_edit')->with('news', $news);
    }

    public function news_edit_submit(Request $request) {
        $image = $request->file('image');
        $url = null;
        if (!empty($image)) {
            $destinationPath = 'file_img';
            $movea = $image->move($destinationPath,$image->getClientOriginalName());
            $url = "file_img/{$image->getClientOriginalName()}";
        }

        $news = News::find($request->id_news);
        $news->title = $request->title;
        $news->content = $request->content;
        if ($url != null) {
            $news->url_image = $url;
        }
        $news->save();


        $files = $request->file('attachment');
        if (!empty($files)) {
            $attachment = NewsAttachment::where('id_news', $request->id_news)->get();
            foreach ($attachment as $key => $value) {
                DB::table('news_attachments')->where('id','=',$value->id)->delete();
            }
            foreach ($files as $key => $file) {
                $destinationPath = 'file_attachment';
                $movea = $file->move($destinationPath,$file->getClientOriginalName());
                $url = "file_attachment/{$file->getClientOriginalName()}";

                $attachment = new NewsAttachment;
                $attachment->id_news = $request->id_news;
                $attachment->attachment_name = $file->getClientOriginalName();
                $attachment->attachment_url = $url;
                $attachment->save();
            }
        }

        Session::flash('success', 'News telah berubah. Anda berhasil melakukan "UPDATE" pada news ini');

        return redirect(action('NewsController@admin_news_view',$request->id_news));
        
    } 

    public function news_remove ($id_news){
        $news = News::find($id_news);
        Session::flash('success', 'Anda berhasil MENGHAPUS news: '. $news->title);

        if ($news == null) {
            return 'error: news not found';
        }
        DB::table('newses')->where('id','=',$id_news)->delete();

        return redirect(action('NewsController@news_list'));
    }

    public function publish_news ($id_news){
        $news = News::find($id_news);
        if ($news == null) {
            return 'error: news not found';
        }
        $news->is_publish = 1;
        $news->save();

        Session::flash('success', 'Anda berhasil melakukan "PUBLISH" pada news ini, news akan tampil di halaman utama web.');

        return redirect(action('NewsController@admin_news_view',$id_news));
    }

    public function news_add()
    {
        return view('admin.news.news_add');
    }

    public function unpublish_news ($id_news){
        $news = News::find($id_news);
        if ($news == null) {
            return 'error: news not found';
        }
        $news->is_publish = 0;
        $news->save();

        Session::flash('success', 'Anda berhasil melakukan "UN-PUBLISH" pada news ini, sehingga news tidak tampil di halaman utama web.');
        return redirect(action('NewsController@admin_news_view',$id_news));
    }
}
