<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Manager;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function login(){
        return view("admin.login");
    }

    public function doLogin(Request $req){
        $manager = (new Manager())->getManager($req->managerId);
        if(empty($manager))
        {
            // back(): 回上一頁
            // withInput(): 保留原本在網頁上輸入的資料
            // withErrors(): 回傳錯誤訊息
            return back()->withInput()->withErrors(["account"=>"帳號錯誤"]);

        }else{
            if($manager->pwd != $req->pwd)
            {
                return back()->withInput()->withErrors(["pwd"=>"密碼錯誤"]);
            }else{
                // 將帳號暫存在記憶體中
                // session可以跨頁存取
                // session存在serverㄝ, 而cookie存在使用者電腦
                session()->put("managerId", $req->managerId);

                // redirect: 轉址
                return redirect("/admin/home");
            }
        }
    }

    public function home()
    {
        return view("admin.home");
    }
}
