<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\ProductService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    use ApiResponseTrait;
    public $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $products = Product::with(['category', 'createdBy'])->latest()->get();
            return $this->success($products);
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $this->productService->createProduct($request);
            return $this->success();
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $Product)
    {
        return $this->success($Product);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            "title" => "required|string|max:255",
            "dec" => "required|string",
            "price" => "required|numeric|min:0",
            "category_id" => "nullable|exists:categories,id",
            "image" => "nullable"
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
        return $this->success($product);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if ($product->image && Storage::disk("public")->exists($product->image)) {
            Storage::disk("public")->delete($product->image);
        }

        $product->delete();
        return $this->success();
    }
}
