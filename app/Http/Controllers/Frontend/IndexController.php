<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\MultiImage;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{


    public function Index() {

        $skip_category0 = Category::skip(0)->first();
        $skip_product0 = Product::where('status',1)->where('category_id',$skip_category0->id)->orderBy('id','DESC')->limit(5)->get();

        return view('frontend.index', compact('skip_category0','skip_product0'));
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



}
