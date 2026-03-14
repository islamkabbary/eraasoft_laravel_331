<?php

namespace App\Http\Controllers;

use App\Events\ProductCreatedEvent;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'createdBy'])->latest()->get();
        return view("products.index", ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize("create",Product::class);
        // if(Gate::allows('create-product')){
        $categories = Category::all();
        return view("products.create", ['categories' => $categories]);
        // }
        // abort(403);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize("create",Product::class);
        $request->validate([
            "title" => "required|string|max:255",
            "dec" => "required|string",
            "price" => "required|numeric|min:0",
            "category_id" => "nullable|exists:categories,id",
            "image" => "nullable|mimes:jpg,png|max:2048"
        ]);

        $data = $request->only(['title', 'dec', 'price', 'category_id']);

        if ($request->hasFile('image')) {
            $file = $request->file("image");
            $path = Storage::disk("public")->put("products", $file);
            $data['image'] = $path;
        }

        $product = Product::create($data);
        event(new ProductCreatedEvent($product));

        return redirect()->route("products.index")->with("success", "Product Created successfully");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $this->authorize("view",Product::class);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $this->authorize("update",Product::class);
        $categories = Category::all();
        return view("products.edit", ['product' => $product, 'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $this->authorize("update",Product::class);
        $request->validate([
            "title" => "required|string|max:255",
            "dec" => "required|string",
            "price" => "required|numeric|min:0",
            "category_id" => "nullable|exists:categories,id",
            "image" => "nullable|mimes:jpg,png|max:2048"
        ]);

        $data = $request->only(['title', 'dec', 'price', 'category_id']);

        if ($request->hasFile('image')) {
            if ($product->image && Storage::disk("public")->exists($product->image)) {
                Storage::disk("public")->delete($product->image);
            }
            $file = $request->file("image");
            $path = Storage::disk("public")->put("products", $file);
            $data['image'] = $path;
        }

        $product->update($data);
        return redirect()->route("products.index")->with("success", "Product Updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->authorize("create-product",$product);
        if (Gate::allows('delete-product',$product)) {
            if ($product->image && Storage::disk("public")->exists($product->image)) {
                Storage::disk("public")->delete($product->image);
            }

            $product->delete();
            return redirect()->route("products.index")->with("success", "Product deleted successfully");
        }
    }
}
