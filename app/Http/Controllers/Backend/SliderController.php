<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class SliderController extends Controller
{
    public function AllSliders() {
        $sliders = Slider::latest()->get();
        return view('backend.slider.all_sliders', compact('sliders'));
    }


    public function AddSlider() {
        return view('backend.slider.add_slider');
    }


    public function SliderStore(Request $request){

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('uploads/slider/'.$name_gen);
        $save_url = 'uploads/slider/'.$name_gen;

        Slider::insert([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Slider Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_sliders')->with($notification);

    }


    public function EditSlider($id){
        $slider = Slider::findOrFail($id);
        return view('backend.slider.edit_slider', compact('slider'));

    }



    public function UpdateSlider(Request $request){

        $slider_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('slider_image')) {

        $image = $request->file('slider_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(2376,807)->save('uploads/slider/'.$name_gen);
        $save_url = 'uploads/slider/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Slider::findOrFail($slider_id)->update([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
            'slider_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Slider image changes updated  successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_sliders')->with($notification);

        } else {

            Slider::findOrFail($slider_id)->update([
            'slider_title' => $request->slider_title,
            'short_title' => $request->short_title,
        ]);

       $notification = array(
            'message' => 'Slider changes updated  successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_sliders')->with($notification);

        } // end else

    }



    public function DeleteSlider($id){
        $slider = Slider::findOrFail($id);
        $img = $slider->slider_image;
        unlink(($img));

        Slider::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Slider has been deleted successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }




}
