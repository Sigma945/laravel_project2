<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Model;

class ProductSpec extends Model
{
    public $timestamps = false;
    protected $table = "product_spec";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "productId",
        "title",
        "content"
    ];

    public function getSpec($productId)
    {
        $list = self::where("productId", $productId)->get();
        return $list;
    }

    public function deleteSpec($productId)
    {
        $list = self::where("productId", $productId)->delete();
        return $list;
    }
}
