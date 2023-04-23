<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AdBanner;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdBannerController extends Controller
{
    public function AllBanners() {
        $banners = AdBanner::latest()->get();
        return view('backend.banner.all_banners', compact('banners'));
    }


    public function AddBanner() {
        return view('backend.banner.add_banner');
    }



    public function BannerStore(Request $request){

        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('uploads/banner/'.$name_gen);
        $save_url = 'uploads/banner/'.$name_gen;

        AdBanner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Banner Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_banners')->with($notification);

    }

    public function EditBanner($id){
        $banner = AdBanner::findOrFail($id);
        return view('backend.banner.edit_banner', compact('banner'));

    }


    public function UpdateBanner(Request $request){

        $banner_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('banner_image')) {

        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('uploads/banner/'.$name_gen);
        $save_url = 'uploads/banner/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        AdBanner::findOrFail($banner_id)->update([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Banner image changes updated  successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_banners')->with($notification);

        } else {

            AdBanner::findOrFail($banner_id)->update([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
        ]);

       $notification = array(
            'message' => 'Banner changes updated  successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_banners')->with($notification);

        } // end else

    }


    public function DeleteBanner($id){
        $banner = AdBanner::findOrFail($id);
        $img = $banner->banner_image;
        unlink(($img));

        AdBanner::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Banner has been deleted successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }


}
