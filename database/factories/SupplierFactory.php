<?php

namespace Database\Factories;

use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Supplier::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'cuit' => $this->faker->unique()->numberBetween(20000000000, 40000000000),
            'businessName' => $this->faker->unique()->numberBetween(20000000, 40000000),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'postalCode' => $this->faker->address(),
            'email' => $this->faker->unique()->email(),
        ];
    }
}
