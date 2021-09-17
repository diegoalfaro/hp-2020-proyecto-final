<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\CustomerPayment;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerPaymentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = CustomerPayment::class;

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
            'amount' => $this->faker->numberBetween(300, 20000),
        ];
    }
}
