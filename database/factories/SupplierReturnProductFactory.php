<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\SupplierReturn;
use App\Models\SupplierReturnProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierReturnProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SupplierReturnProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $supplierReturn = SupplierReturn::all()->random();
        $product = Product::all()->random();

        return [
            'supplier_return_id' => $supplierReturn->id,
            'product_id' => $product->id,
            'quantity' => $this->faker->numberBetween(1, 30),
            'list_price' => $product->list_price,
        ];
    }
}
