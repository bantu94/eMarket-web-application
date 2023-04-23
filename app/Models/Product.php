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
        // Matching vendor id with id in categories table
        return $this->belongsTo(Category::class,'category_id','id');
    }

}
