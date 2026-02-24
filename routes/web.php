<?php

use App\Http\Controllers\PageController;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('welcome');
// });



Route::get("hello", function () {
    return "hello laravel";
});

Route::get("user/{id}", function ($id) {
    return "user Id" . $id;
})->where("id", '[0-9]+');

Route::get("product/{category}/{id}", function ($category, $id) {
    return "product_id => $id" . "category_id => $category";
})->where(['category' => '[0-9]+', 'id' => '[0-9]+']);


// Route::get("user/{name?}", function ($name = "Guest") {
//     return "name" . " " . $name;
// })->where("name", '[A-Za-z]+');

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



Route::get('/', [PageController::class, "home"]);
Route::get('login', [PageController::class, "login"])->name('login');
Route::get('/cart', [PageController::class, "cart"])->name('cart');




Route::POST('sign-in', [PageController::class, "sign_in"])->name('sign_in');









Route::get("product", function () {
    // dd(Product::where("status","draft")->first());
    // $product = new Product();
    // $product = Product::find(1);
    // $product->title = "lap";
    // $product->dec = "test";
    // $product->price = "50000";
    // $product->save();

    // Product::create([
    //     "title" => "lap create",
    //     "dec" => "test create",
    //     "price" => "80000",
    //     "image" => "test/test.png",
    // ]);

    // $product = Product::find(2);
    // $product->update([
    //     "title" => "lap create",
    //     "dec" => "test create",
    //     "price" => "80000",
    //     "image" => "test/test.png",
    // ]);
    // Product::find(2)->delete();

    // $products = Product::where("status", "!=", "draft")
    //                     ->where("created_at", '>=', now()->subDays(7))
    //                     ->get();
    // $products = Product::where("title","like","%test%")->get();
    // $products = Product::limit(3)->get();
    $products = Product::skip(5)->take(2)->get();
    $products = Product::whereIn("id", [1, 5])->get();
    $products = Product::whereNotIn("id", [1, 5])->get();
    $products = Product::paginate(5);
    dd($products);
});



Route::get('user', function () {
    $user = User::create([
        "name" => "ahmed",
        "email" => "ahmed@gmail.com",
        "password" => Hash::make(123456),
    ]);

    $user->profile()->create([
        "phone" => "01201891564",
        "address" => "alex",
        "bio" => "test"
    ]);

    dd($user, $user->profile);
});


Route::get('profile', function () {
    // $user = User::find(1);
    // echo $user->profile->phone;


    $profile = Profile::find(1);
    echo $profile->user->email;
});

Route::get('cat', function () {
    // $cat = Category::create([
    //     "name" => "Elc",
    // ]);

    $cat = Category::find(3);

    // $cat->products()->createMany([
    //     [
    //         "title" => "create many title",
    //         "dec" => "create many dec",
    //         "price" => "50"
    //     ],
    //     [
    //         "title" => "create many title 2",
    //         "dec" => "create many dec 2",
    //         "price" => "100"
    //     ]
    // ]);

    dd($cat, $cat->products, $cat->products()->first()->category->name);
});

Route::get("order", function () {
    // // $order = Order::create([
    // //     "user_id" => 1,
    // //     "total_price" => 5000,
    // // ]);

    // $order = Order::with("products")->find(6);
    // dd($order);

    // // $order->products()->attach([
    // //     1 => ['qty' => 5, 'price' => 10],
    // //     2 => ['qty' => 2, 'price' => 3],
    // //     3 => ["qty" => 50, 'price' => 100]
    // // ]);

    // foreach($order->products as $product){
    //     echo $product->title , "<br>";
    //     echo $product->pivot->qty , "<br>";
    //     echo $product->pivot->price , "<br>";
    // }


    // $orders = DB::table("orders")->get();
    $orders = DB::table("orders")->where('id',5)->first();


    $product_id = DB::table('products')->insertGetId([
        "category_id" => 1,
        "title" => "test q",
        "dec" => "test dec q",
        "price" => 50000
    ]);
    dd($product_id);

});

// Route::get("order-u", function () {
//     // $order = Order::create([
//     //     "user_id" => 1,
//     //     "total_price" => 5000,
//     // ]);

//     $order = Order::find(5);

//     // $order->products()->updateExistingPivot(1,['qty' => 5000, 'price' => 500]);
//     $order->products()->detach();

//     foreach($order->products as $product){
//         echo $product->title , "<br>";
//         echo $product->pivot->qty , "<br>";
//         echo $product->pivot->price , "<br>";
//     }

// });











Route::get("faker-products",function(){
    Product::factory(10000)->create();
});

