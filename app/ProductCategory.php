<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name', 'description', 'status'];
    public function product(){
        return $this->hasOne(Product::class);
    }
}
