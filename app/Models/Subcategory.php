<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;

    protected $guarded = [];

    // creating subcategory and category  relationship

    public function category_relation(){
        return $this->belongsTo(Category::class,'category_id','id');
    }

}