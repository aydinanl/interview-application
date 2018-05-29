<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\Utility;
use App\Models\Contact;
use App\Models\Pages;
use App\Models\Posts;
use App\Models\Slider;
use App\Models\Stats;
use App\Models\Widget;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class DashboardCtrl extends Controller
{
    public function index(Request $request)
    {
        if($request->session()->get('token') && $request->session()->get('id')){
            return view('admin.dashboard', [
                'user' => $request->user
            ]);
        }else{
            return redirect("/login" );
        }
    }

    public function editHome(Request $request)
    {
        $sliders = Slider::all();
        if($request->session()->get('token') && $request->session()->get('id')){
            return view('admin.editHome', [
                'user' => $request->user,
                'sliders' => $sliders
            ]);
        }else{
            return redirect("/login" );
        }
    }

    public function saveSlider(Request $request)
    {
        $slider = new Slider;

        $slider->link = '#';
        if(isset($request->link)){
            $slider->link = trim($request->link);
        }
        $slider->save();
        if(Input::hasFile('slider_img')){
            $image = Input::file('slider_img');
            $imageName = $slider->id . '.' . $image->getClientOriginalExtension();
            $image->move(public_path() . '/img/slider/', $imageName);
            $imagePath = '/img/slider/' . $imageName;
        }
        if(isset($imagePath)){
            $slider->img = $imagePath;
        }
        $slider->save();
        return redirect('/admin/cons-edit/home');
    }

    public function deleteSlider($id)
    {
        $slider = Slider::find($id);

        $slider->delete();
        return redirect('/admin/cons-edit/home');
    }

    public function saveWidget(Request $request)
    {
        $widget = new Widget;

        $findWidget = Widget::where('widget_id',$request->id)->first();

        if(isset($findWidget)){
            $widget = $findWidget;
        }

        $widget->widget_id = $request->id;

        if(isset($request->icon)){
            $widget->widget_icon = trim($request->icon);
        }
        if(isset($request->title)){
            $widget->widget_title = trim($request->title);
        }
        if(isset($request->contents)){
            $widget->widget_content = trim($request->contents);
        }
        $widget->save();

        return redirect('/admin/cons-edit/home');
    }
}
