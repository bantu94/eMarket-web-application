<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\VendorProduct;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class VendorProductController extends Controller
{
    public function VendorProducts() {

        $user_id = Auth::user()->id;
        $products = Product::where('vendor_id',$user_id)->latest()->get();
        return view('vendor.VendorProducts.vendor_products', compact('products'));
    }

    public function VendorAddProduct() {

        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        return view('vendor.VendorProducts.vendor_add_products', compact('brands','categories'));
    }


    public function GetVendorSubCategory($category_id){
        $subcat = Subcategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
            return json_encode($subcat);

    }


    public function StoreVendorProduct(Request $request){

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('uploads/products/thumbnail/'.$name_gen);
        $save_url = 'uploads/products/thumbnail/'.$name_gen;

        $product_id = Product::insertGetId([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'product_thumbnail' => $save_url,
            'vendor_id' => Auth::user()->id,
            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        /// Multiple Image Upload  //////

        $images = $request->file('multi_img');
        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(800,800)->save('uploads/products/multiImages/'.$make_name);
        $uploadPath = 'uploads/products/multiImages/'.$make_name;


        MultiImage::insert([

            'product_id' => $product_id,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),

        ]);
        } // end foreach

        /// End Multiple Image Upload From her //////

        $notification = array(
            'message' => 'Vendor Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor_products')->with($notification);

    }



    public function EditVendorProduct($id) {

        $brands = Brand::latest()->get();
        $categories = Category::latest()->get();
        $subcategory = Subcategory::latest()->get();
        $products = Product::findOrFail($id);

        $multi_Img = MultiImage::where('product_id',$id)->get();

        return view('vendor.VendorProducts.edit_vendor_product', compact('brands','categories','subcategory','products','multi_Img'));
    }


    public function UpdateVendorProduct(Request $request) {
        $product_id = $request->id;

        Product::findOrFail($product_id)->update([

            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ','-',$request->product_name)),

            'product_code' => $request->product_code,
            'product_quantity' => $request->product_quantity,
            'product_tags' => $request->product_tags,
            'product_size' => $request->product_size,
            'product_color' => $request->product_color,

            'selling_price' => $request->selling_price,
            'discount_price' => $request->discount_price,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,

            'hot_deals' => $request->hot_deals,
            'featured' => $request->featured,
            'special_offer' => $request->special_offer,
            'special_deals' => $request->special_deals,

            'status' => 1,
            'created_at' => Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Vendor Product Updated Successfully | Image not changed',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor_products')->with($notification);
    }




    public function UpdateVendorProductThumbnail(Request $request) {

        $old_image = $request->old_image;
        $prod_ID = $request->id;

        $image = $request->file('product_thumbnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('uploads/products/thumbnail/'.$name_gen);
        $save_url = 'uploads/products/thumbnail/'.$name_gen;

        if (file_exists($old_image)) {
            unlink($old_image);
        }

        Product::findOrFail($prod_ID)->update([
            'product_thumbnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Vendor Product Thumbnail Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }


    public function UpdateVendorProductMultiImages(Request $request) {

        $images = $request->multi_img;

        foreach ($images as $id => $imgValue) {
            $imageDelete = MultiImage::findOrFail($id);
            unlink($imageDelete->photo_name);

            $make_name = hexdec(uniqid()).'.'.$imgValue->getClientOriginalExtension();
            Image::make($imgValue)->resize(800,800)->save('uploads/products/multiImages/'.$make_name);
            $uploadPath = 'uploads/products/multiImages/'.$make_name;

            MultiImage::where('id',$id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }



        $notification = array(
            'message' => 'Vendor Product Multi-Image Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }


    public function DeleteVendorMultiImage($id) {
        $old_image = MultiImage::findOrFail($id);
        unlink($old_image->photo_name);

        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Vendor Multi-Image Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }




    public function VendorInactivateProduct($id) {
        Product::findOrFail($id)->update([
            'status' => 0
        ]);

        $notification = array(
            'message' => 'Product Inactivated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    public function VendorActivateProduct($id) {
        Product::findOrFail($id)->update([
            'status' => 1
        ]);

        $notification = array(
            'message' => 'Product Activated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }



    public function DeleteVendorProduct($id) {
        $product = Product::findOrFail($id);
        unlink($product->product_thumbnail);
        Product::findOrFail($id)->delete();

        $images = MultiImage::where('product_id',$id)->get();
        foreach ($images as $image) {
            unlink($image->photo_name);
            MultiImage::where('product_id',$id)->delete();
        }

        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);


    }







}
