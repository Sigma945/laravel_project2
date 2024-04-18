<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Model;

class ProductContent extends Model
{
    public $timestamps = false;
    protected $table = "product_content";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "productId",
        "content"
    ];

    public function getContent($productId)
    {
        $content = self::where("productId", $productId)->first();
        return $content;
    }
}
