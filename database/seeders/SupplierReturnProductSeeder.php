<?php

namespace Database\Seeders;

use App\Models\SupplierReturnProduct;
use Illuminate\Database\Seeder;

class SupplierReturnProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SupplierReturnProduct::factory(50)->create();
    }
}
