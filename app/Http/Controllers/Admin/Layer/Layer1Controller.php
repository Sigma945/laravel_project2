<?php

namespace App\Http\Controllers\Admin\Layer;

use App\Http\Controllers\Controller;
use App\Models\Admin\Layer\Layer1;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Layer1Controller extends Controller
{
    public function list()
    {
        $list = Layer1::get();
        Session::forget("info");    //後臺更新資料後刪除session，前台重新讀取資料
        return view("admin.layer1.list", compact("list"));
    }

    public function add()
    {
        return view("admin.layer1.add");
    }

    public function insert(Request $req)
    {
        $layer1 = new Layer1();
        $layer1->layer1_name = $req->layer1_name;
        $layer1->save();

        Session::flash("message", "已新增");
        return redirect("/admin/layer1");
    }

    public function edit(Request $req)
    {
        $layer1 = Layer1::find($req->id);
        return view("admin.layer1.edit", compact("layer1"));
    }

    public function update(Request $req)
    {
        $layer1 = Layer1::find($req->id);
        $layer1->layer1_name = $req->layer1_name;
        $layer1->save();

        Session::flash("message", "已修改");
        return redirect("/admin/layer1");
    }

    public function delete(Request $req)
    {
        Layer1::destroy($req->id);
        Session::flash("message", "已刪除");
        return redirect("/admin/layer1");
    }

    public function search(Request $req)
    {
        $list = (new Layer1())->search($req->keyword);
        return view("admin.layer1.search", compact("list"));
    }

    public function getLayer1(Request $req)
    {
        $list = Layer1::find($req->id);
        return response()->json($list);
    }

    public function getFrontLayer1()
    {
        $list = Layer1::all();
        return response()->json($list);
    }
}
