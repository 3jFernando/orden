<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $fillable = [        
        'name',
        'bio',
        'image'
    ];

    // user de la tienda
    public function users() 
    {
        return $this->hasMany(User::class);
    }

    // categorias de la tienda 1:n
    public function categories() 
    {
        return $this->hasMany(Category::class);
    }

    // contactos de la tienda 1:n
    public function contacts() 
    {
        return $this->hasMany(Contact::class);
    }

    // ventas 
    public function sales()
    {
        return $this->hasMany(Sale::class);
    }

    // compras 
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }

}
