<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProductBrand;

class ProductBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            'BOSCH',
            'ACDelco',
            'VALEO',
            'Febi Bilstein',
            'DELPHI',
            'CASTROL',
            'MONROE',
            'Continental AG',
            'BREMBO',
            'LuK',
            'Grupo ZF',
            'DENSO',
            'MANN - FILTRO',
        ];

        foreach ($brands as $brand) {
            ProductBrand::create([
                'name' => $brand
            ]);
        }
    }
}
