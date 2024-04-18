<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Banner extends Model
{
    public $timestamps = false;
    protected $table = "banner";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "apId",
        "photo",
    ];

    public function getList()
    {
        $list = DB::table("banner as a")
            ->selectRaw("a.*, b.ap_name")
            ->leftjoin("ap as b", "a.apId", "b.id")
            ->get();

        return $list;
    }

    public function getBanner($apId)
    {
        $list = self::where("apId", $apId)->first();
        return $list;
    }

}
