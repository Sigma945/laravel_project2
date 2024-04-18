<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Banner;
use App\Models\Admin\Layer\Layer1;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\ProductContent;
use App\Models\Admin\Product\ProductPhoto;
use App\Models\Admin\Product\ProductShop;
use App\Models\Admin\Product\ProductSpec;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // 前端取list
    public function getList(Request $req)
    {
        $list = (new Product())->getLayer1Product($req->layer1);
        return response()->json($list);
    }

    public function list(Request $req)
    {
        $list = (new Product())->getLayer1Product($req->layer1);
        $banner = (new Banner())->getBanner(1);
        return view("front.product.list", compact("list", "banner"));
    }

    public function detail(Request $req)
    {
        $layer1 = Layer1::find($req->layer1);
        $id = $req->id;

        $product = Product::find($id);
        $photo = (new ProductPhoto())->getPhoto($id);
        $spec = (new ProductSpec())->getSpec($id);
        $shop = (new ProductShop())->getShop($id);

        return view("front.product.detail", compact("layer1", "product", "photo", "spec", "shop"));
    }

    public function getProduct(Request $req)
    {
        $id = $req->id;
        $product = Product::find($id);
        return response()->json($product);
    }

    public function getPhoto(Request $req)
    {
        $id = $req->productId;
        $photo = (new ProductPhoto())->getPhoto($id);
        return response()->json($photo);
    }

    public function getSpec(Request $req)
    {
        $id = $req->productId;
        $spec = (new ProductSpec())->getSpec($id);
        return response()->json($spec);
    }

    public function getShop(Request $req)
    {
        $id = $req->productId;
        $shop = (new ProductShop())->getShop($id);
        return response()->json($shop);
    }

    public function getContent(Request $req)
    {
        return response()->json((new ProductContent())->getContent($req->productId));
    }
}
