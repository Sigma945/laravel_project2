<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Admin\Product\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $product = (new Product())->getHomeProduct();
    
        return view("front.home", compact("product"));
    }

    public function getHomeProduct()
    {
        $product = (new Product())->getHomeProduct();
    
        return response()->json($product);
    }
}
