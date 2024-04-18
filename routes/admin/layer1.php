<?php

use App\Http\Controllers\Admin\Layer\Layer1Controller;
use Illuminate\Support\Facades\Route;

    Route::group(["middleware" => "manager", "prefix" => "admin/layer1"],function(){
        Route::get("/", [Layer1Controller::class, "list"]);
        Route::get("add", [Layer1Controller::class, "add"]);
        Route::post("insert", [Layer1Controller::class, "insert"]);
        Route::get("edit/{id}", [Layer1Controller::class, "edit"]);
        Route::post("update", [Layer1Controller::class, "update"]);
        Route::post("delete", [Layer1Controller::class, "delete"]);
        Route::post("search", [Layer1Controller::class, "search"]);
    });