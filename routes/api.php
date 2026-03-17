<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;




Route::apiResource("products", ProductController::class)->middleware('auth:sanctum');

Route::get('/categories', function () {
    return response()->json([
        Category::get()
    ]);
});


Route::post("/login",[AuthController::class,'login']);
Route::post("/logout",[AuthController::class,'logout'])->middleware('auth:sanctum');