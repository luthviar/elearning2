<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Slider;
use Session;
use Carbon\Carbon;

class SliderController extends Controller
{
    // MIDDLEWARE
    public function __construct()
    {
        $this->middleware('auth', ['except' => [
             'get_active_slider', 'get_all_slider','view_slider_user'
        ]]);
        $this->middleware('isAdmin', ['except' => [
             'get_active_slider', 'get_all_slider', 'view_slider_user'
        ]]);
        
    }

    public function view_slider_user($id_slider){
        $slider = Slider::find($id_slider);
        if($slider == null){
            return "error: slider not found";
        }
        return view('user.slider_view')->with('slider',$slider);
    }
    
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

    public function slider_list () {
        return view('admin.slider.slider');
    }

    public function slider_list_serverside(Request $request){
        $columns = array( 
                            0 =>'title', 
                            1 =>'second_title',
                            2 => 'created_at',
                            3 => 'flag_active',
                        );
  
        $totalData = Slider::count();
            
        $totalFiltered = $totalData; 

        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $columns[$request->input('order.0.column')];
        $dir = $request->input('order.0.dir');
            
        if(empty($request->input('search.value')))
        {   
            $sliders = Slider::offset($start)
                         ->limit($limit)
                         ->orderBy($order,$dir)
                         ->get();
        } else {
            $search = $request->input('search.value'); 

            $sliders =  Slider::where('title','LIKE',"%{$search}%")
                            ->orWhere('second_title', 'LIKE',"%{$search}%")
                            ->orWhere('created_at', 'LIKE',"%{$search}%")
                            ->offset($start)
                            ->limit($limit)
                            ->orderBy($order,$dir)
                            ->get();

            $totalFiltered = Slider::where('title','LIKE',"%{$search}%")
                             ->orWhere('second_title', 'LIKE',"%{$search}%")
                             ->orWhere('created_at', 'LIKE',"%{$search}%")
                             ->count();
        }

        $data = array();
        if(!empty($sliders))
        {
            foreach ($sliders as $slider)
            {
                $nestedData['title'] = "<a href='".url(action('SliderController@view_slider',$slider->id))."'>".$slider->title."</a>";
                $nestedData['second_title'] = $slider->second_title;
                $nestedData['created_at'] = date('j M Y',strtotime($slider->created_at));
                if ($slider->flag_active == 1) {
                    $nestedData['status'] = "active";
                } else {
                    $nestedData['status'] = "non active";
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

    public function add_slider (){
        return view('admin.slider.slider_add');
    }

    public function slider_add_submit (Request $request) {
        $image = $request->file('image');
        $url = null;
        if (!empty($image)) {
            $destinationPath = 'file_img';
            $movea = $image->move($destinationPath,$image->getClientOriginalName());
            $url = "/file_img/{$image->getClientOriginalName()}";
        }
        


//        $slider = new Slider;
//        $slider->created_by = \Auth::user()->id;
//        $slider->title = $request->title;
//        $slider->second_title = $request->second_title;
//        $slider->url_image = $url;
//        $slider->save();

        $id_slider = DB::table('sliders')-> insertGetId(array(
            'created_by' => \Auth::user()->id,
            'title' => $request->title,
            'second_title' => $request->second_title,
            'url_image' => $url,
            'created_at' => Carbon::now('Asia/Jakarta'),
        ));

        Session::flash('success',
            'Anda berhasil menambahkan SLIDER baru, silahkan ACTIVATE slider tersebut agar tampil pada halaman utama. 
            ACTIVATE dapat dilakukan pada tombol berikut: ');
        Session::flash('success-slider', $id_slider);

        return redirect(action('SliderController@slider_list'));
    }

    public function view_slider ($id_slider) {
        $slider = Slider::find($id_slider);
        if ($slider == null) {
            return "error : slider not found";
        }
        $count_slider_active = Slider::where('flag_active',1)->count();
        return view('admin.slider.slider_view')->with('slider', $slider)->with('count', $count_slider_active);
    }

    public function edit_slider ($id_slider) {
        $slider = Slider::find($id_slider);
        if ($slider == null) {
            return "error : slider not found";
        }
        return view('admin.slider.slider_edit')->with('slider', $slider);
    }

    public function edit_slider_submit(Request $request) {
        $image = $request->file('image');
        $url = null;
        if (!empty($image)) {
            $destinationPath = 'file_img';
            $movea = $image->move($destinationPath,$image->getClientOriginalName());
            $url = "/file_img/{$image->getClientOriginalName()}";
        }


        $slider = Slider::find($request->id_slider);
        if ($slider == null) {
            return 'error: slider not found';
        }
        $slider->title = $request->title;
        $slider->second_title = $request->second_title;
        if ($url != null) {
            $slider->url_image  = $url;
        }
        $slider->save();

        return redirect(action('SliderController@view_slider',$request->id_slider));
    }  

    public function activate ($id_slider) {
        $slider = Slider::find($id_slider);
        if ($slider == null) {
            return "error: slider not found";
        }
        $count_slider_active = Slider::where('flag_active',1)->count();
        if ($count_slider_active >= 5) {
            return "error: amound of slider active exceeded the limit";
        }
        $slider->flag_active = 1;
        $slider->save();

        Session::flash('success',
            'Slider ini berhasil diaktifkan. Slider ini akan tampil di halaman utama user.');

        return redirect(action('SliderController@view_slider',$id_slider));
    }

    public function nonactivate ($id_slider) {
        $slider = Slider::find($id_slider);
        if ($slider == null) {
            return "error: slider not found";
        }
        $count_slider_active = Slider::where('flag_active',1)->count();
        if ($count_slider_active == 1) {
            return "error: amound of slider active exceeded the limit";
        }
        $slider->flag_active = 0;
        $slider->save();

        Session::flash('success',
            'Slider ini berhasil NON-AKTIF. Slider ini sudah tidak tampil di halaman utama user.');

        return redirect(action('SliderController@view_slider',$id_slider));

    }

    public function delete_slider($id_slider) {
        $slider = Slider::find($id_slider);
        if ($slider == null) {
            return "error: slider not found";
        }
        DB::table('sliders')->where('id','=',$id_slider)->delete();

        return redirect(action('SliderController@slider_list'));
    }
}
