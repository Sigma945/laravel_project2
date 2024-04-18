<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\ProductPhoto;
use App\Models\Admin\Product\Resize;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PhotoController extends Controller
{
    public function add(Request $req)
    {
        $productId = $req->productId;
        return view("admin.photo.add", compact("productId"));
    }

    public function insert(Request $req)
    {
        $photo = $req->photo;
        $times = explode(" ", microtime());
        $photoName = strftime("%Y_%m_%d_%H_%M_%S_", $times[1]) . substr($times[0], 2, 3) . "." . $photo->extension();
        $photo->move("images/product", $photoName);

        $path = "images/product/";
        new Resize($path."M/" . $photoName, $path.$photoName, 490, 490, '0', '0');
        new Resize($path."S/" . $photoName, $path.$photoName, 80, 80, '0', '0');

        $fs = new ProductPhoto();
        $fs->productId = $req->productId;
        $fs->photo = $photoName;
        $fs->save();

        Session::flash("message", "圖檔已新增");
        return redirect("/admin/product/edit/" . $req->productId . "#tabs-2");
    }

    public function delete(Request $req)
    {
        $productId = "";
        if(!empty($req->photoId)){
            foreach($req->photoId as $data){
                $photo = ProductPhoto::find($data);
                $productId = $photo->productId;
                @unlink("images/product/" . $photo->photo);
                @unlink("images/product/M/" . $photo->photo);
                @unlink("images/product/S/" . $photo->photo);
                $photo->delete();
            }
            Session::flash("message", "圖檔已刪除");
            return redirect("/admin/product/edit/" . $productId . "#tabs-2");
        }else{
            Session::flash("message", "請選擇要刪除的圖檔");
            return redirect()->back();
        }
    }
}
