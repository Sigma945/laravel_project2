<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    public $timestamps = false;
    protected $table = "shop";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "shopName"
    ];

    public function checkName($shopName)
    {
        $shop = self::where("shopName", $shopName)->first();
        return $shop;
    }
}
