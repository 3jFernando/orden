<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = "categories";

    protected $fillable = [
        'shop_id',
        'name',
        'slug',
    ];

    // tienda
    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    // productos
    public function products()
    {
        return $this->hasMany(Product::class);
    }

}
