<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Product;
use App\Models\BudgetProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BudgetProduct::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $budget = Budget::all()->random();
        $product = Product::all()->random();

        return [
            'budget_id' => $budget->id,
            'product_id' => $product->id,
            'quantity' => $this->faker->numberBetween(1, 30),
            'list_price' => $product->list_price,
        ];
    }
}
