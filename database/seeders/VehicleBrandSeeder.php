<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleBrand;

class VehicleBrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            'Abarth',
            'Alfa Romeo',
            'Aston Martin',
            'Audi',
            'Bentley',
            'BMW',
            'Cadillac',
            'Caterham',
            'Chevrolet',
            'Citroen',
            'Dacia',
            'Ferrari',
            'Fiat',
            'Ford',
            'Honda',
            'Infiniti',
            'Isuzu',
            'Iveco',
            'Jaguar',
            'Jeep',
            'Kia',
            'KTM',
            'Lada',
            'Lamborghini',
            'Lancia',
            'Land Rover',
            'Lexus',
            'Lotus',
            'Maserati',
            'Mazda',
            'Mercedes-Benz',
            'Mini',
            'Mitsubishi',
            'Morgan',
            'Nissan',
            'Opel',
            'Peugeot',
            'Piaggio',
            'Porsche',
            'Renault',
            'Rolls-Royce',
            'Seat',
            'Skoda',
            'Smart',
            'SsangYong',
            'Subaru',
            'Suzuki',
            'Tata',
            'Tesla',
            'Toyota',
            'Volkswagen',
            'Volvo',
        ];

        foreach ($brands as $brand) {
            VehicleBrand::create([
                'name' => $brand
            ]);
        }
    }
}
