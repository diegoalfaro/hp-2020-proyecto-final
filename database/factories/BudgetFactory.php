<?php

namespace Database\Factories;

use App\Models\Budget;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Budget::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'customer_id' => Customer::all()->random()->id,
            'date' => $this->faker->date(),
            'due_date' => $this->faker->date(),
            'workforce_cost' => $this->faker->numberBetween(300, 20000),
        ];
    }
}
