<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'contact_id',
        'discount',
        'total',
        'total_utility',
    ];

    // contacto
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    // productos
    public function products()
    {
        return $this->hasMany(SaleProduct::class);
    }

}
