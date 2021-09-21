<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerReturn;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerReturnFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerReturn::class;

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
        ];
    }
}