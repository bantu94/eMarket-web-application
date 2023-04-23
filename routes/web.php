<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Backend\AdBannerController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Users\UserController;
use App\Http\Controllers\Vendor\VendorController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\RedirectIfAuthenticated;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('frontend.index');
});

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('dashboard');
    Route::post('/user/profile', [UserController::class, 'UserProfileStore'])->name('user_profile_store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user_logout');
    Route::post('/update/user/password', [UserController::class, 'UpdateUserPassword'])->name('update_user_password');

});


Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



// ADMIN DASHBOARD

Route::get('/login/admin', [AdminController::class, 'AdminLogin'])->name('admin_login')->middleware(RedirectIfAuthenticated::class);

Route::group(['middleware' => ['auth','role:admin']], function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin_dashboard');
    Route::get('/logout/admin', [AdminController::class, 'AdminLogout'])->name('admin_logout');
    Route::get('/profile/admin', [AdminController::class, 'AdminProfile'])->name('admin_profile');
    Route::post('/store/profile/admin', [AdminController::class, 'AdminProfileStore'])->name('admin_profile_store');
    Route::get('/change/password/admin', [AdminController::class, 'AdminChangePassword'])->name('admin_change_password');
    Route::post('/update/admin/password', [AdminController::class, 'UpdateAdminPassword'])->name('update_admin_password');
});


// VENDOR DASHBOARD
Route::get('/login/vendor', [VendorController::class, 'VendorLogin'])->name('vendor_login')->middleware(RedirectIfAuthenticated::class);


// *************************FRONTEND***********************************
Route::get('/become/vendor', [VendorController::class, 'BecomeVendor'])->name('become_vendor');
Route::post('/register/vendor', [VendorController::class, 'VendorRegister'])->name('vendor_register');
// ***********************END**FRONTEND***********************************

// ***********************VENDOR**PROTECTED***********************************
Route::group(['middleware' => ['auth','role:vendor']], function () {
    Route::get('/vendor/dashboard', [VendorController::class, 'VendorDashboard'])->name('vendor_dashboard');
    Route::get('/logout/vendor', [VendorController::class, 'VendorLogout'])->name('vendor_logout');
    Route::get('/profile/vendor', [VendorController::class, 'VendorProfile'])->name('vendor_profile');
    Route::post('/store/profile/vendor', [VendorController::class, 'VendorProfileStore'])->name('vendor_profile_store');
    Route::get('/change/password/vendor', [VendorController::class, 'VendorChangePassword'])->name('vendor_change_password');
    Route::post('/update/vendor/password', [VendorController::class, 'UpdateVendorPassword'])->name('update_vendor_password');



    // *************************Vendor Products********************************
    Route::controller(VendorProductController::class)->group(function() {
        Route::get('/vendor/products', 'VendorProducts')->name('vendor_products');
        Route::get('/vendor/add/product', 'VendorAddProduct')->name('vendor_add_product');
        Route::post('/store/vendor/product', 'StoreVendorProduct')->name('store_vendor_product');


        Route::get('/edit/vendor/product/{id}', 'EditVendorProduct')->name('edit_vendor_product');
        Route::post('/update/vendor/product', 'UpdateVendorProduct')->name('update_vendor_product');
        Route::post('/update/vendor/thumbnail/product', 'UpdateVendorProductThumbnail')->name('update_vendor_product_thumbnail');


        Route::post('/update/vendor/multi-image/product', 'UpdateVendorProductMultiImages')->name('update_vendor_product_multi-image');
        Route::get('/delete/vendor/multi-image/{id}', 'DeleteVendorMultiImage')->name('delete_vendor_multi-image');


        Route::get('/vendor/inactivate/product/{id}', 'VendorInactivateProduct')->name('vendor_inactivate_product');
        Route::get('/vendor/activate/product/{id}', 'VendorActivateProduct')->name('vendor_activate_product');

        Route::get('/delete/vendor/product/{id}', 'DeleteVendorProduct')->name('delete_vendor_product');


        Route::get('/vendor/subcategory/ajax/{category_id}' , 'GetVendorSubCategory');


    });



});


// ***********************ADMIN**PROTECTED***********************************
Route::group(['middleware' => ['auth','role:admin']], function () {


    // *********************************BRAND*********************************
    Route::controller(BrandController::class)->group(function() {
        Route::get('/brands', 'AllBrands')->name('all_brands');
        Route::get('/add/brand', 'AddBrand')->name('add_brand');
        Route::post('/store/brands', 'BrandStore')->name('brand_store');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit_brand');
        Route::post('/update/brand', 'UpdateBrand')->name('update_brand');
        Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete_brand');
    });


    // *********************************CATEGORIES*********************************
     Route::controller(CategoryController::class)->group(function() {
        Route::get('/categories', 'AllCategories')->name('all_categories');
        Route::get('/add/category', 'AddCategory')->name('add_category');
        Route::post('/store/category', 'CategoryStore')->name('category_store');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit_category');
        Route::post('/update/category', 'UpdateCategory')->name('update_category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete_category');
    });


    // *********************************SUBCATEGORIES*********************************
     Route::controller(SubcategoryController::class)->group(function() {
        Route::get('/subcategories', 'AllSubcategories')->name('all_subcategories');
        Route::get('/add/subcategory', 'AddSubcategory')->name('add_subcategory');
        Route::post('/store/subcategory', 'SubcategoryStore')->name('subcategory_store');
        Route::get('/edit/subcategory/{id}', 'EditSubcategory')->name('edit_subcategory');
        Route::post('/update/subcategory', 'UpdateSubcategory')->name('update_subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubcategory')->name('delete_subcategory');

        Route::get('/subcategory/ajax/{category_id}' , 'GetSubCategory');
    });


    // ******************************VENDOR MANAGEMENT*******************************
     Route::controller(AdminController::class)->group(function() {
        Route::get('/inactive/vendor', 'InactiveVendor')->name('inactive_vendor');
        Route::get('/active/vendor', 'ActiveVendor')->name('active_vendor');
        Route::get('/inactive/vendor/details/{id}', 'InactiveVendorDetails')->name('inactive_vendor_details');
        Route::post('/approve/vendor', 'ApproveVendor')->name('approve_vendor');
        Route::get('/active/vendor/details/{id}', 'ActiveVendorDetails')->name('active_vendor_details');
        Route::post('/disapprove/vendor', 'DisapproveVendor')->name('disapprove_vendor');

    });

    // ******************************PRODUCT MANAGEMENT*******************************
     Route::controller(ProductController::class)->group(function() {
        Route::get('/all/products', 'AllProducts')->name('all_products');
        Route::get('/add/product', 'AddProduct')->name('add_product');
        Route::post('/store/product', 'StoreProduct')->name('store_product');
        Route::get('/edit/product/{id}', 'EditProduct')->name('edit_product');
        Route::post('/update/product', 'UpdateProduct')->name('update_product');

        Route::post('/update/product/thumbnail', 'UpdateProductThumbnail')->name('update_product_thumbnail');
        Route::post('/update/product/multi-images', 'UpdateProductMultiImages')->name('update_product_multiImages');
        Route::get('/delete/product/multi-image/{id}', 'DeleteMultiImage')->name('delete_multi_image');


        Route::get('/inactivate/product/{id}', 'InactivateProduct')->name('inactivate_product');
        Route::get('/activate/product/{id}', 'ActivateProduct')->name('activate_product');


        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete_product');

    });



    // *********************************SLIDER*********************************
    Route::controller(SliderController::class)->group(function() {
        Route::get('/sliders', 'AllSliders')->name('all_sliders');
        Route::get('/add/sliders', 'AddSlider')->name('add_slider');
        Route::post('/store/slider', 'SliderStore')->name('slider_store');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit_slider');
        Route::post('/update/slider', 'UpdateSlider')->name('update_slider');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete_slider');

    });

    // *********************************Ad BANNER*********************************
    Route::controller(AdBannerController::class)->group(function() {
        Route::get('/banners', 'AllBanners')->name('all_banners');
        Route::get('/add/banner', 'AddBanner')->name('add_banner');
        Route::post('/store/banner', 'BannerStore')->name('banner_store');
        Route::get('/edit/banner/{id}', 'EditBanner')->name('edit_banner');
        Route::post('/update/banner', 'UpdateBanner')->name('update_banner');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete_banner');

    });



});  // ********END**********ADMIN**PROTECTED***********************************



// ********FRONTEND************PRODUCT DETAILS***********************************
Route::get('/product/details/{id}/{slug}', [IndexController::class, 'ProductDetails']);





