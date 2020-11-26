<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'reference',
        'quantity',
        'price_purchase',
        'price_sale',
        'utility',
    ];

    // categoria
    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}
