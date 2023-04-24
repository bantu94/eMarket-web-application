<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function vendor_relation() {
        // Matching vendor id with id in users table
        return $this->belongsTo(User::class,'vendor_id','id');
    }

    public function category_relation() {
        // Matching vendor id with id in categories table &&
        // Matching  category_name	with in category_id products table
        return $this->belongsTo(Category::class,'category_id','id');
    }


    public function subcategory_relation() {
        // Matching  subcategory_name with in products table
        return $this->belongsTo(Subcategory::class,'subcategory_id','id');
    }


    public function brand_relation() {
        // Matching  brand_name	 with in products table
        return $this->belongsTo(Brand::class,'brand_id','id');
    }

}
