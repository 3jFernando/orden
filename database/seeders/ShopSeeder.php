<?php

namespace Database\Seeders;

use App\Models\Shop;
use Illuminate\Database\Seeder;

class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::create([
            'id' => 1,
            'name' => 'Tienda PLLS',
            'bio' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Unde veritatis earum consequatur, nulla dolor minus aut vero, modi ipsa voluptatum sequi eligendi ullam iste, laudantium quis reiciendis id enim fugiat.',
            'image' => 'image.jpg',
        ]);
    }
}
