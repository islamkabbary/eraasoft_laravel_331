<?php

use App\Http\Controllers\Api\ProductController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;




Route::apiResource("products", ProductController::class);
Route::get('/categories', function () {
    return response()->json([
        Category::get()
    ]);
});
