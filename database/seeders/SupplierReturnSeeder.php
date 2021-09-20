<?php

namespace Database\Seeders;

use App\Models\SupplierReturn;
use Illuminate\Database\Seeder;

class SupplierReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SupplierReturn::factory(50)->create();
    }
}
