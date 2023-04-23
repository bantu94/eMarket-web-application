<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    public function AllCategories() {
        $categories = Category::latest()->get();
        return view('backend.category.all_categories', compact('categories'));
    }

    public function AddCategory() {
        return view('backend.category.add_categories');
    }


    public function CategoryStore(Request $request){

        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(300,300)->save('uploads/category/'.$name_gen);
        $save_url = 'uploads/category/'.$name_gen;

        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_categories')->with($notification);

    }


    public function EditCategory($id){
        $category = Category::findOrFail($id);
        return view('backend.category.edit_category', compact('category'));

    }

    public function UpdateCategory(Request $request){

        $category_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('category_image')) {

        $image = $request->file('category_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120,120)->save('uploads/category/'.$name_gen);
        $save_url = 'uploads/category/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
            'category_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Category image changes updated  successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_categories')->with($notification);

        } else {

            Category::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-',$request->category_name)),
        ]);

       $notification = array(
            'message' => 'Category changes updated  successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all_categories')->with($notification);

        } // end else

    }

    public function DeleteCategory($id){
        $category = Category::findOrFail($id);
        $img = $category->category_image;
        unlink(($img));

        Category::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Category has been deleted successfully',
            'alert-type' => 'info'
        );

        return redirect()->back()->with($notification);

    }


}
