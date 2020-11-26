<?php

namespace Database\Seeders;

use App\Models\{
    User,
    Category,
    Contact,
    Product
};
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(ShopSeeder::class);
        $this->call(TypeContactSeeder::class);
        
        User::factory(1)->create();        
        Category::factory(10)->create();            
        Contact::factory(30)->create();        
        Product::factory(50)->create();        
    }
}
