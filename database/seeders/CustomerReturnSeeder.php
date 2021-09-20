<?php

namespace Database\Seeders;

use App\Models\CustomerReturn;
use Illuminate\Database\Seeder;

class CustomerReturnSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomerReturn::factory(50)->create();
    }
}
