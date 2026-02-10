<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get("hello", function () {
    return "hello laravel";
});

Route::get("user/{id}", function ($id) {
    return "user Id" . $id;
})->where("id",'[0-9]+');

Route::get("product/{category}/{id}", function ($category, $id) {
    return "product_id => $id" . "category_id => $category";
})->where(['category' => '[0-9]+', 'id' => '[0-9]+']);


Route::get("user/{name?}", function ($name = "Guest") {
    return "name" . " " . $name;
})->where("name",'[A-Za-z]+');

// index.php?page=user&id=500
// route("show_user",['id' => 500,'cat=> 'elc']);
// user/500;