<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\ProductSpec;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SpecController extends Controller
{
    public function add(Request $req)
    {
        $productId = $req->productId;
        return view("admin.spec.add", compact("productId"));
    }

    public function insert(Request $req)
    {
        $productId = $req->productId;
        $spec = new ProductSpec();
        $spec->productId = $productId;
        $spec->title = $req->title;
        $spec->content = $req->content;
        $spec->save();

        Session::flash("message", "規格已新增");
        return redirect("/admin/product/edit/" . $productId . "#tabs-3");
    }

    public function edit(Request $req)
    {
        $productId = $req->productId;
        $id = $req->id;

        $spec = ProductSpec::find($id);

        return view("admin.spec.edit", compact("productId", "id", "spec"));
    }

    public function update(Request $req)
    {
        $productId = $req->productId;
        $id = $req->id;

        $spec = ProductSpec::find($id);
        $spec->title = $req->title;
        $spec->content = $req->content;
        $spec->save();

        Session::flash("message", "規格已修改");
        return redirect("/admin/product/edit/" . $productId . "#tabs-3");
    }

    public function delete(Request $req)
    {
        $productId = "";
        if(!empty($req->specId))
        {
            foreach($req->specId as $id){
                $spec = ProductSpec::find($id);
                $productId = $spec->productId;
                $spec->delete();
            }

            Session::flash("message", "規格已刪除");
            return redirect("/admin/product/edit/" . $productId . "#tabs-3");
        }else{
            Session::flash("message", "請選擇要刪除的規格");
            return redirect()->back();
        }
    }
}
