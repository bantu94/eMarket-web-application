<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{


    public function Index() {

        $skip_category0 = Category::skip(0)->first();
        $skip_product0 = Product::where('status',1)->where('category_id',$skip_category0->id)->orderBy('id','DESC')->limit(5)->get();

        $skip_category2 = Category::skip(2)->first();
        $skip_product2 = Product::where('status',1)->where('category_id',$skip_category2->id)->orderBy('id','DESC')->limit(5)->get();

        $skip_category3 = Category::skip(3)->first();
        $skip_product3 = Product::where('status',1)->where('category_id',$skip_category3->id)->orderBy('id','DESC')->limit(5)->get();

        $hot_deal = Product::where('hot_deals',1)->where('discount_price','!=',NULL)->orderBy('id','DESC')->limit(3)->get();

        $special_offer = Product::where('special_offer',1)->where('discount_price','!=',NULL)->limit(3)->get();

        $special_deals = Product::where('special_deals',1)->where('discount_price','!=',NULL)->limit(3)->get();

        $recents = Product::where('status',1)->orderBy('id','DESC')->limit(3)->get();


        return view('frontend.index', compact('skip_category0','skip_product0','skip_category2','skip_product2','skip_category3','skip_product3','hot_deal','special_offer','special_deals','recents'));
    }



    public function ProductDetails($id,$slug) {

        $product = Product::findOrFail($id);

        $color = $product->product_color;
        $product_color = explode(',',$color);

        $size = $product->product_size;
        $product_size = explode(',',$size);

        $multiImages = MultiImage::where('product_id',$id)->get();

        $cat_id = $product->category_id;
        $relatedproduct = Product::where('category_id',$cat_id)->where('id','!=',$id)->orderBy('id','DESC')->limit(4)->get();

        return view('frontend.Product.product_details', compact('product','product_color','product_size','multiImages','relatedproduct'));

    }

    public function VendorDetails($id) {

        $vendor = User::findOrFail($id);
        $vendorProducts = Product::where('vendor_id',$id)->get();

        return view('frontend.vendor.vendor_details', compact('vendor','vendorProducts'));

    }

    public function VendorList() {

        $vendors = User::where('status','active')->where('role','vendor')->orderBy('id','DESC')->get();

        return view('frontend.vendor.vendor_list',compact('vendors'));

    }



}
