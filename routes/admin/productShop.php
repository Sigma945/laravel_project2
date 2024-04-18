<?php

use App\Http\Controllers\Admin\Product\ProductShopController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/productShop"],function(){
    Route::get("/", [ProductShopController::class, "list"]);
    Route::get("add/{productId}", [ProductShopController::class, "add"]);
    Route::post("insert", [ProductShopController::class, "insert"]);
    Route::get("edit/{productId}/{id}", [ProductShopController::class, "edit"]);
    Route::post("update", [ProductShopController::class, "update"]);
    Route::post("delete", [ProductShopController::class, "delete"]);
});