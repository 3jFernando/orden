<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'product_id',
        'quantity',
        'price_sale_unit',
        'total',
        'utility',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

}
