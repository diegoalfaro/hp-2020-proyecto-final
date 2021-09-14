<?php

namespace Database\Seeders;

use App\Models\BudgetProduct;
use Illuminate\Database\Seeder;

class BudgetProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        BudgetProduct::factory(50)->create();
    }
}
