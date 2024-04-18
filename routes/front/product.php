<?php

use App\Http\Controllers\Front\ProductController;
use Illuminate\Support\Facades\Route;


Route::group(["middleware" => "info", "prefix" => "product"],function(){
    Route::get("detail/{layer1}/{id}",[ProductController::class, "detail"]);
    Route::get("list/{layer1}",[ProductController::class, "list"]);
});
    