<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeContact extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = 'type_contacts';

    protected $fillable = [
        'name'
    ];
}
