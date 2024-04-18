<?php

use App\Http\Controllers\Admin\BannerController;
use Illuminate\Support\Facades\Route;

    Route::group(["middleware" => "manager", "prefix" => "admin/banner"],function(){
        Route::get("/", [BannerController::class, "list"]);
        Route::get("add", [BannerController::class, "add"]);
        Route::post("insert", [BannerController::class, "insert"]);
        Route::get("edit/{apId}", [BannerController::class, "edit"]);
        Route::post("update", [BannerController::class, "update"]);
        Route::post("delete", [BannerController::class, "delete"]);
    });