<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    private function get_random_product_name()
    {
        $products = [
            'Correa de Distribución',
            'Correa Auxiliar y Tensores',
            'Bomba de Agua',
            'Bombas y Inyectores',
            'Embrague y Bimasa',
            'Sistema de Lubricación',
            'Sistema de Enfriamiento',
            'Turbo de Intercooler',
            'Juntas Homocinéticas',
            'Arbol de Transmisión',
            'Palieres',
            'Juntas de Cardan',
            'Rodamientos',
            'Guarda Polvos',
            'Amortiguadores y muelles',
            'Barras Estabilizadoras',
            'Silentblocks y cojinetes elásticos',
            'Rótulas',
            'Mangueta y Buje',
            'Tirante de Suspensión',
            'Topes de Suspensión',
            'Dirección Hidráudica',
            'Dirección Electrica',
            'Bomba de Presión',
            'Tubería',
            'Rótula Axial',
            'Rótula de Dirección',
            'Líquido Hidráulico',
            'Batería',
            'Alternador',
            'Motor de arranque',
            'Aceite',
            'Filtro',
            'Pastilla de freno',
            'Disco de freno',
            'Neumático',
            'Escobilla',
            'Luz',
            'Parabrisas',
        ];
        return $products[array_rand($products)];
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cost_price = $this->faker->unique()->numberBetween(500, 20000);
        $profit = $this->faker->unique()->numberBetween(500, 2000);
        $list_price = $cost_price + $profit;

        return [
            'supplier_id' => Supplier::all()->random()->id,
            'product_brand_id' => ProductBrand::all()->random()->id,
            'name' => $this->get_random_product_name(),
            'cost_price' => $cost_price,
            'list_price' => $list_price,
            'initial_stock' => $this->faker->unique()->numberBetween(20, 100),
        ];
    }
}
