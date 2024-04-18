<?php

namespace App\Models\Admin\Product;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProductShop extends Model
{
    public $timestamps = false;
    protected $table = "product_shop";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "productId",
        "shopId",
        "url"
    ];

    public function getShop($productId)
    {
        $list = DB::table("product_shop AS a")
            ->selectRaw("a.*, b.shopName")
            ->join("shop AS b", "a.shopId", "b.id")
            ->where("a.productId", $productId)
            ->get();    
        
        return $list;
    }

    public function getAddShop($productId)
    {
        $list = DB::table("shop")
            ->whereNotIn("id",
                DB::table("product_shop")->selectRaw("shopId")->where("productId",$productId))
            ->get();

        // SELECT * FROM shop WHERE id NOT IN (SELECT shopId FROM product WHERE productId=$productId)
        
        /*  
            另一種方式
            $list = DB::select("SELECT * FROM shop WHERE id NOT IN
            (SELECT shopId FROM product WHERE productId=?), [$productId]");
        */
        
        return $list;
    }

    public function getShopName($id)
    {
        $list = DB::table("product_shop as a")
            ->selectRaw("a.*, b.shopName")
            ->join("shop AS b", "a.shopId", "b.id")
            ->where("a.id", $id)
            ->first();
        
        return $list;
    }

    public function deleteShop($productId)
    {
        self::where("productId", $productId)->delete();
    }
}
