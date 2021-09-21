<?php

namespace Database\Seeders;

use App\Models\SupplierPayment;
use Illuminate\Database\Seeder;

class SupplierPaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SupplierPayment::factory(50)->create();
    }
}
