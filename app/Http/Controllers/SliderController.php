<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slider;

class SliderController extends Controller
{
    
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
        return view('admin.slider');
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

                $nestedData['title'] = "<a href='".url('/admin_slider',$slider->id)."'>".$slider->title."</a>";
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
}
