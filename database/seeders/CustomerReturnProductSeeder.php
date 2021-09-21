<?php

namespace Database\Seeders;

use App\Models\CustomerReturnProduct;
use Illuminate\Database\Seeder;

class CustomerReturnProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerReturnProduct::factory(50)->create();
    }
}
