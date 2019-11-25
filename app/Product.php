<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
//    protected $fillable = ['name', 'image', 'category_id', 'description', 'supplier_id'];
    public function category(){
        return $this->belongsTo(ProductCategory::class);
    }

    public function supplier(){
        return $this->belongsTo(User::class);
    }
}
