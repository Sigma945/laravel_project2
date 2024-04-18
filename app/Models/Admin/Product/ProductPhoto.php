<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    public $timestamps = false;
    protected $table = "product_photo";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "productId",
        "photo"
    ];

    public function getPhoto($productId)
    {
        $list = self::where("productId", $productId)->get();
        return $list;
    }

    public function deletePhoto($productId)
    {
        $list = self::where("productId", $productId)->delete();
        return $list;
    }
}
