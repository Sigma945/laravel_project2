<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Ap;
use App\Models\Admin\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BannerController extends Controller
{
    public function list()
    {
        $list = Banner::get();
        return view("admin.banner.list", compact("list"));
    }

    public function add()
    {
        $list = Ap::get();
        return view("admin.banner.add", compact("list"));
    }

    public function insert(Request $req)
    {
        $id = $req->id;

        $photo = $req->photo;
        $times = explode(" ", microtime());
        $photoName = strftime("%Y_%m_%d_%H_%M_%S_", $times[1]) . substr($times[0], 2, 3) . "." . $photo->extension();
        $photo->move("images/banner", $photoName);

        $banner = new Banner();
        $banner->apId = $id;
        $banner->photo = $photoName;
        $banner->save();

        Session::flash("message", "Banner已新增");
        return redirect("/admin/banner/");
    }
}
