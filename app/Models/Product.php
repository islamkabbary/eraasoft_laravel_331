<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $table = "migrations";
    protected $fillable = ["title", 'dec', 'price','image'];
    // protected $guarded = ["id",'title'];
}