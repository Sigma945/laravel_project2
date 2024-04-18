<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

require __DIR__."/layer1.php";
require __DIR__."/product.php";
require __DIR__."/productShop.php";
require __DIR__."/shop.php";
require __DIR__."/photo.php";
require __DIR__."/spec.php";
require __DIR__."/banner.php";


    Route::group(["prefix" => "admin"],function(){
        Route::get("/",[AdminController::class, "login"]);
        Route::post("doLogin",[AdminController::class, "doLogin"]);
        Route::get("home",[AdminController::class, "home"])->middleware("manager");
    });