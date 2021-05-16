<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table='product';
    protected $fillable=['user_id','product_name','product_description', 'cover_image'];


    public function procductimage(){
        return $this->hasOne('App\ProductImages','product_id','id')->select('product_images.id','product_images.product_id',\DB::raw("CONCAT('".url('/public/data/product/')."/', product_images.image) AS image"));
    }

    public function productimagedetails(){
        return $this->hasMany('App\ProductImages','product_id','id')->select('product_id',\DB::raw("CONCAT('".url('/public/data/product/')."/', image) AS productimage"));
    }
}
