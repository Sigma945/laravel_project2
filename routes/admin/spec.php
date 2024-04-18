<?php

use App\Http\Controllers\Admin\Product\SpecController;
use Illuminate\Support\Facades\Route;

Route::group(["middleware" => "manager", "prefix" => "admin/spec"],function(){
    Route::get("/", [SpecController::class, "list"]);
    Route::get("add/{productId}", [SpecController::class, "add"]);
    Route::post("insert", [SpecController::class, "insert"]);
    Route::get("edit/{productId}/{id}", [SpecController::class, "edit"]);
    Route::post("update", [SpecController::class, "update"]);
    Route::post("delete", [SpecController::class, "delete"]);
});