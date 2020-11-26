<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'contact_id',
        'subtotal',
        'discount',
        'total'
    ];

    // contacto
    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    // productos
    public function products()
    {
        return $this->hasMany(PurchaseProduct::class);
    }

}
