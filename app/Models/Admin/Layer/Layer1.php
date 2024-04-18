<?php

namespace App\Models\Admin\Layer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layer1 extends Model
{
    public $timestamps = false;
    protected $table = "layer1";
    protected $primaryKey = "id";
    protected $fillable = [
        "id",
        "layer1_name"
    ];

    public function search($keyword)
    {
        $list = self::where("layer1_name", "LIKE", "%" . $keyword . "%")->get();
        return $list;
    }
}
