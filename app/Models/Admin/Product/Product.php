<?php

namespace App\Models\Admin\Product;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    public $timestamps = false;
    protected $table = "product";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "layer1",
        "title",
        "sub_title",
        "home"
    ];

    public function getList()
    {
        $list = DB::table("product as a")
            ->selectRaw("a.*, b.layer1_name")
            ->join("layer1 AS b", "a.layer1", "b.id")
            ->orderBy("a.layer1", "ASC")
            ->paginate(10);     //分頁,每頁10筆
        
        return $list;
    }

    public function getHomeProduct()
    {
        $list = DB::select("SELECT id, layer1, title, sub_title,
        (SELECT photo FROM product_photo WHERE productId = a.id ORDER BY RAND() LIMIT 1)AS photo FROM product a WHERE home = 'Y'");

        return $list;
    }

    public function getLayer1Product($layer1)
    {
        $list = DB::select("SELECT id, layer1, title, sub_title,
        (SELECT photo FROM product_photo WHERE productId = a.id ORDER BY RAND() LIMIT 1)AS photo FROM product a WHERE layer1 = ?", [$layer1]);

        return $list;
    }
}
