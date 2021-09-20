<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\CustomerReturn;
use App\Models\CustomerReturnProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerReturnProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerReturnProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $customerReturn = CustomerReturn::all()->random();
        $product = Product::all()->random();

        return [
            'customer_return_id' => $customerReturn->id,
            'product_id' => $product->id,
            'quantity' => $this->faker->numberBetween(1, 30),
            'list_price' => $product->list_price,
        ];
    }
}
