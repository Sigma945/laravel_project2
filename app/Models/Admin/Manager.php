<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public $timestamps = false;
    protected $table = "manager";
    protected $primaryKey = "managerId";
    protected $fillable = [
        "managerId",
        "pwd"
    ];

    public function getManager($managerId)
    {
        // $manager = DB::table("manager")->where("managerId", $managerId)->first();
        // self = DB::table("manager")
        $manager = self::where("managerId", $managerId)->first();

        return $manager;
    }
}
