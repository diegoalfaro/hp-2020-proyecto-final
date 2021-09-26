<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\Supplier;
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
        $cost_price = $this->faker->unique()->numberBetween(500, 20000);
        $profit = $this->faker->unique()->numberBetween(500, 2000);
        $list_price = $cost_price + $profit;

        return [
            'supplier_id' => Supplier::all()->random()->id,
            'product_brand_id' => ProductBrand::all()->random()->id,
            'name' => $this->faker->company(),
            'cost_price' => $cost_price,
            'list_price' => $list_price,
            'initial_stock' => $this->faker->unique()->numberBetween(20, 100),
        ];
    }
}
