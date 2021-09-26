<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ProductDetailsTable extends Component
{
    public $products;
    public $footerLines;

    public function __construct($products, $footerLines)
    {
        $this->products = $products;
        $this->footerLines = $footerLines;
    }

    public function render()
    {
        return view('components.product-details-table');
    }
}
