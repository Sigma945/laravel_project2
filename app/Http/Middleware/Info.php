<?php

namespace App\Http\Middleware;

use App\Models\Admin\Layer\Layer1;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Info
{
    public function handle(Request $request, Closure $next): Response
    {
        if(empty(session()->get("info")))
        {
            // 取得大分類
            session()->put("layer1", Layer1::get());
            // 之後可以再加入logo，功能選單，footer等，或者加上流量計數器

            // 表示已經取得資料，除非資料有變動，才會再次取得資料
            session()->put("info", "Y");
        }
        return $next($request);
    }
}
