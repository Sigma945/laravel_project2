<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\ProductShop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ProductShopController extends Controller
{
    
    
    public function add(Request $req)
    {
        $productId = $req->productId;
        $list = (new ProductShop())->getAddShop($productId);

        return view("admin.productShop.add", compact("productId", "list"));
    }

    public function insert(Request $req)
    {
        $shop = new ProductShop();
        $shop->productId = $req->productId;
        $shop->shopId = $req->shopId;
        $shop->url = $req->url;
        $shop->save();

        Session::flash("message", "已新增");
        return redirect("admin/product/edit/" . $req->productId . "#tabs-4");
    }

    public function delete(Request $req)
    {
        $productId = "";
        if(!empty($req->shopId)){
            foreach($req->shopId as $shopId)
            {
                $shop = ProductShop::find($shopId);
                $productId = $shop->productId;
                $shop->delete();
            }
            Session::flash("message", "產品商店已刪除");
            return redirect("admin/product/edit/" . $productId . "#tabs-4");

        }else{
            Session::flash("message", "請選擇要刪除的商店");
            return redirect()->back();
        }
    }

    public function edit(Request $req)
    {
        $productId = $req->productId;
        $id = $req->id;

        $shop = ProductShop::find($id);
        $list = (new ProductShop())->getShopName($id);

        return view("admin.productShop.edit", compact("productId", "id", "shop", "list"));
    }

    public function update(Request $req)
    {
        $productId = $req->productId;
        $id = $req->id;
        $shopName = $req->shopId;

        $shop = ProductShop::find($id);
        $shop->url = $req->url;
        $shop->save();

        Session::flash("message", "產品商店資料已修改");
        return redirect("admin/product/edit/" . $productId . "#tabs-4");
    }
}
