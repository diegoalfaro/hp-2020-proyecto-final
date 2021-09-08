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
        return [
            'provider'=> $this->faker->provider(),
            'name'=> $this->faker->name(),
            'mark'=> $this->faker->mark(),
            'cost'=> $this->faker->cost(),
            'gains'=> $this->faker->gains(),
            'list_price'=> $this->faker->list_price(),
            'existence'=> $this->faker->existence()
        ];
    }
}
