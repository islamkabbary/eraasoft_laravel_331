<?php

namespace App\Http\Resources;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "product_id" => $this->id,
            "product_title" => $this->title,
            "price_with_tax" => $this->price_with_tax,
            "is_exp" => $this->price > 20000,
            // "image" => $this->image ? asset("storage/" . $this->image) : null,
            "image" => $this->when($this->image,asset("storage/" . $this->image)),
            // "category" => new CategoryResource($this->category),
            // "category" => $this->category?->name,
            // "category" => [
            //     "id" => $this->category?->id,
            //     "name" => $this->category?->name
            // ],
            "category" => new CategoryResource($this->whenLoaded('category')),
        ];
    }
}
