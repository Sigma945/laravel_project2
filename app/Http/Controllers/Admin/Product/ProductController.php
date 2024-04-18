<?php

namespace App\Http\Controllers\Admin\Product;

use App\Http\Controllers\Controller;
use App\Models\Admin\Layer\Layer1;
use App\Models\Admin\Product\Product;
use App\Models\Admin\Product\ProductContent;
use App\Models\Admin\Product\ProductPhoto;
use App\Models\Admin\Product\ProductShop;
use App\Models\Admin\Product\ProductSpec;
use App\Models\Admin\Product\Resize;
use App\Models\Admin\Shop;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    public function list()
    {
        $list = (new Product())->getList();

        return view("admin.product.list", compact("list"));
    }

    public function add()
    {
        $layer1 = Layer1::get();
        $shop = Shop::all();
        return view("admin.product.add", compact("layer1", "shop"));
    }

    public function insert(Request $req)
    {
        DB::beginTransaction();
        try{
            $id = $this->addProduct($req);
            $this->addPhoto($id);
            $this->addSpec($id);
            $this->addProductShop($id);
            $this->addProductContent($id, $req);

            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            throw $e;
        }

        Session::flash("message", "已新增");
        return redirect("/admin/product");
    }

    private function addProduct(Request $req)
    {
        $product = new Product();
        $product->layer1 = $req->layer1;
        $product->title = $req->title;
        $product->sub_title = $req->sub_title;
        $product->home = $req->home;
        $product->save();

        return $product->id;
    }

    private function addPhoto($id)
    {
        // 取得所有輸入資料
        $input = request()->all();

        // 如果public資料夾下沒有images資料夾
        if(!file_exists("images")){
            // 在public下建立images, 權限允許讀取,執行,寫入
            mkdir("images", 0777, true);
        }

        if(!file_exists("images/product")){
            mkdir("images/product", 0777, true);
        }

        foreach(range("1", "5")as $cnt){
            if(!empty($input["file" . $cnt])){
                $file = $input["file" . $cnt];
                $times = explode(" ", microtime());
                $fileName = strftime("%Y_%m_%d_%H_%M_%S_", $times[1]) . substr($times[0], 2, 3) . "." . $file->extension();
                $file->move("images/product", $fileName);

                //更改圖片大小 
                $path = "images/product/";
                new Resize($path."M/" . $fileName, $path.$fileName, 490, 490, '0', '0');
                new Resize($path."S/" . $fileName, $path.$fileName, 80, 80, '0', '0');

                $photo = new ProductPhoto();
                $photo->productId = $id;
                $photo->photo = $fileName;
                $photo->save();
            }
        }
    }

    private function addSpec($id)
    {
        $input = request()->all();
        for($i = 1; $i <= 10; $i++){
            if(!empty($input["title" . $i]))
            {
                $spec = new ProductSpec();
                $spec->productId = $id;
                $spec->title = $input["title" . $i];
                $spec->content = $input["content" . $i];
                $spec->save();
            }
        }
    }

    private function addProductShop($id)
    {
        $list = Shop::get();
        $input = request()->all();
        foreach($list as $data)
        {
            if(!empty($input["shop" . $data->id]))
            {
                $shop = new ProductShop();
                $shop->productId = $id;
                $shop->shopId = $data->id;
                $shop->url = $input["url" . $data->id];
                $shop->save();
            }
        }
    }

    public function edit(Request $req)
    {
        $product = Product::find($req->id);
        $shop = (new ProductShop())->getShop($req->id);
        $photo = (new ProductPhoto())->getPhoto($req->id);
        $spec = (new ProductSpec())->getSpec($req->id);
        $layer1 = Layer1::get();
        $shopList = Shop::all();

        return view("admin.product.edit", compact("product", "shop", "photo", "spec", "layer1", "shopList"));
    }

    public function update(Request $req)
    {
        $product = Product::find($req->id);
        $product->layer1 = $req->layer1;
        $product->title = $req->title;
        $product->sub_title = $req->sub_title;
        $product->home = $req->home;
        $product->save();

        Session::flash("message", "已修改");
        return redirect("/admin/product");
    }

    public function delete(Request $req)
    {
        if(!empty($req->id))
        {
            foreach($req->id as $id)
            {
                DB::beginTransaction();
                try{
                    // 產品圖列表
                    $photoList = (new ProductPhoto())->getPhoto($id);
                    // 如果產品圖不是空的,且資料筆數大於0
                    if(!empty($photoList) && sizeof($photoList) >0)
                    {
                        foreach($photoList as $photo){
                            // 從檔案刪除產品圖
                            /* 
                                以後做專案或case，要詢問業主或窗口
                                當刪除產品時，是否一併刪除圖檔
                                因為一旦刪除無法還原
                            */
                            @unlink("images/product/" . $photo->photo);
                        }

                        // 刪除產品圖
                        (new ProductPhoto())->deletePhoto($id);
                    }

                    (new ProductSpec())->deleteSpec($id);
                    (new ProductShop())->deleteShop($id);
                    Product::destroy($id);
                    DB::commit();
                }catch(Exception $e){
                    DB::rollback();
                    throw $e;
                }
            }

            Session::flash("message", "產品已刪除");
            return redirect("/admin/product");
        }else{
            Session::flash("message", "請選擇要刪除的產品");
            return redirect()->back();
        }
    }

    private function addProductContent($productId, Request $req)
    {
        $content = new ProductContent();
        $content->productId = $productId;
        $content->content = $req->content;
        $content->save();
    }
}
