<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::get("hello", function () {
    return "hello laravel";
});

Route::get("user/{id}", function ($id) {
    return "user Id" . $id;
})->where("id", '[0-9]+');

Route::get("product/{category}/{id}", function ($category, $id) {
    return "product_id => $id" . "category_id => $category";
})->where(['category' => '[0-9]+', 'id' => '[0-9]+']);


Route::get("user/{name?}", function ($name = "Guest") {
    return "name" . " " . $name;
})->where("name", '[A-Za-z]+');

// index.php?page=user&id=500
// route("show_user",['id' => 500,'cat=> 'elc']);
// user/500;





// Route::get("home",function(){
//     $name = "islam";
//     $age = 30;
//     $skills = ["html","css","MySQL","PHP","Laravel"];
//     return view("home",['userName' => $name,'age' => $age,'skills' => $skills]);
//     // return view("home",compact('name','age'));
//     // return view("home")->with(['userName' => $name,'age' => $age]);
// });





// Route::get("home", function () {
//     return view("home");
// });

// Route::get("cart", function () {
//     return view("cart");
// })->name("cart");



Route::get('/home/{test?}', [PageController::class, "home"]);
Route::get('login', [PageController::class, "login"])->name('login');
Route::get('/cart', [PageController::class, "cart"])->name('cart');




Route::POST('sign-in', [PageController::class, "sign_in"])->name('sign_in');
































