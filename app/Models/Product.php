<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    // protected $table = "migrations";
    protected $fillable = ["title", 'dec', 'price', 'image'];
    // protected $guarded = ["id",'title'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class,OrderItem::class)->withPivot("qty","price");
    }
}