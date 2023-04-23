<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function AllSubcategories() {
        $subcategories = Subcategory::latest()->get();
        return view('backend.category.all_subcategories', compact('subcategories'));
    }


    public function AddSubcategory() {
        $categories = Category::orderBy('category_name', 'ASC')->get();
        return view('backend.category.add_subcategories', compact('categories'));
    }


    public function SubcategoryStore(Request $request){

        Subcategory::insert([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)),
        ]);

       $notification = array(
            'message' => 'SubCategory Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_subcategories')->with($notification);

    }


    public function EditSubcategory($id){

        $categories = Category::orderBy('category_name', 'ASC')->get();
        $subcategory = Subcategory::findOrFail($id);
        return view('backend.category.edit_subcategory', compact('categories','subcategory'));

    }


    public function UpdateSubcategory(Request $request){

        $subcategory_id = $request->id;

        Subcategory::findOrFail($subcategory_id)->update([
            'category_id' => $request->category_id,
            'subcategory_name' => $request->subcategory_name,
            'subcategory_slug' => strtolower(str_replace(' ', '-',$request->subcategory_name)),
        ]);

       $notification = array(
            'message' => 'Subcategory updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_subcategories')->with($notification);


    }


    public function DeleteSubcategory($id){

        Subcategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Subcategory has been deleted successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }


    public function GetSubCategory($category_id){
        $subcat = Subcategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
            return json_encode($subcat);

    }



}
