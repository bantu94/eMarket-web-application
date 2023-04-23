<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
    public function AllBrands() {
        $brands = Brand::latest()->get();
        return view('backend.brand.all_brands', compact('brands'));
    }


    public function AddBrand() {
        return view('backend.brand.add_brand');
    }




    public function BrandStore(Request $request){

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('uploads/brand/'.$name_gen);
        $save_url = 'uploads/brand/'.$name_gen;

        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
            'brand_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_brands')->with($notification);

    }


    public function EditBrand($id){
        $brand = Brand::findOrFail($id);
        return view('backend.brand.edit_brand', compact('brand'));

    }


    public function UpdateBrand(Request $request){

        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('uploads/brand/'.$name_gen);
        $save_url = 'uploads/brand/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Brand::findOrFail($brand_id)->update([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
            'brand_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Brand image changes updated  successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_brands')->with($notification);

        } else {

             Brand::findOrFail($brand_id)->update([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
        ]);

       $notification = array(
            'message' => 'Brand changes updated  successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_brands')->with($notification);

        } // end else

    }



    public function DeleteBrand($id){
        $brand = Brand::findOrFail($id);
        $img = $brand->brand_image;
        unlink(($img));

        Brand::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Brand has been deleted successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }





}
