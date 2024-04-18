<?php

use App\Http\Controllers\Admin\Layer\Layer1Controller;
use App\Http\Controllers\Front\ProductController;
use App\Http\Controllers\Front\HomeController;
use Illuminate\Support\Facades\Route;

Route::get("/getHomeProduct", [HomeController::class, "getHomeProduct"]);
Route::group(["prefix" => "product"],function(){
    Route::get("getProduct/{id}", [ProductController::class, "getProduct"]);
    Route::get("getPhoto/{productId}", [ProductController::class, "getPhoto"]);
    Route::get("getSpec/{productId}", [ProductController::class, "getSpec"]);
    Route::get("getShop/{productId}", [ProductController::class, "getShop"]);
    Route::get("getContent/{productId}", [ProductController::class, "getContent"]);
    Route::get("getList/{layer1}", [ProductController::class, "getList"]);
});

Route::group(["prefix" => "layer"],function(){
    Route::get("getLayer1/{id}", [Layer1Controller::class, "getLayer1"]);
    Route::get("getFrontLayer1", [Layer1Controller::class, "getFrontLayer1"]);
});
