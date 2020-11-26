<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $total = rand(50000, 500000);

        return [
            'category_id' => rand(1, 10),
            'name' => $this->faker->name,
            'image' => 'products/default.png',
            'reference' => $this->faker->phoneNumber,            
            'price_sale' => $total,
            'utility' => $total
        ];
    }
}
