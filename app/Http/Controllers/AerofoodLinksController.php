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

class AerofoodLinksController extends Controller
{

    public function index(){
        $links = AerofoodLink::all();

        return view('admin.links.links')->with('links', $links);
    }

    public function view($id){
        $aero_link = AerofoodLink::find($id);
        if ($aero_link == null) {
            return 'error : Links not found';
        }

        return view('admin.links.links_view')->with('aero_link',$aero_link);
    }

    public function edit($id){
        $aero_link = AerofoodLink::find($id);
        if ($aero_link == null) {
            return 'error : Links not found';
        }

        return view('admin.links.links_edit')->with('aero_link',$aero_link);
    }

    public function update(Request $request){

        $aero_link = AerofoodLink::find($request->id_link);
        $aero_link->name= $request->name;
        $aero_link->detail_url = $request->detail_url;
        $aero_link->status = $request->status;
        $aero_link->save();

        Session::flash('success', 'Anda berhasil meng-update LINK ini.');

        return redirect(action('AerofoodLinksController@view',$aero_link->id));
    }

    public function remove($id){
        $aero_link = AerofoodLink::find($id);
        if ($aero_link == null) {
            return 'error: news not found';
        }
        Session::flash('success', 'Anda berhasil menghapus LINK berikut : '.$aero_link->url);

        DB::table('aerofood_links')->where('id','=',$id)->delete();

        return redirect(action('AerofoodLinksController@index'));
    }

    public function add() {
        return view('admin.links.links_add');
    }

    public function create(Request $request) {

        $id_link = DB::table('aerofood_links')->insertGetId(
            [
                'name'         => $request->name,
                'detail_url'         => $request->detail_url,
                'url'         => $request->url,
                'status'         => $request->status,
                'color'         => $request->color,
            ]
        );

        $url_link = AerofoodLink::find($id_link);

        Session::flash('success', 'Anda berhasil menambahkan LINK berikut : '.$url_link->url);
        return redirect(action('AerofoodLinksController@index'));
    }

}
