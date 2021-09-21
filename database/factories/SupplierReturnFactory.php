<?php

namespace Database\Factories;

use App\Models\Supplier;
use App\Models\SupplierReturn;
use Illuminate\Database\Eloquent\Factories\Factory;

class SupplierReturnFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SupplierReturn::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'supplier_id' => Supplier::all()->random()->id,
            'date' => $this->faker->date(),
        ];
    }
}