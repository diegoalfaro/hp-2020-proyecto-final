<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public $items;
    public $avatarSrc;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->items = [
            (object) [
                'title' => __('sections.home.title'),
                'icon' => __('sections.home.icon'),
                'href' => route('home'),
                'active' => request()->route()->named('home')
            ],
            (object) [
                'title' => __('sections.orders.title'),
                'icon' => __('sections.orders.icon'),
                'href' => route('orders'),
                'active' => request()->route()->named('orders')
            ],
            (object) [
                'title' => __('sections.products.title'),
                'icon' => __('sections.products.icon'),
                'href' => route('products'),
                'active' => request()->route()->named('products')
            ],
            (object) [
                'title' => __('sections.customers.title'),
                'icon' => __('sections.customers.icon'),
                'href' => route('customers'),
                'active' => request()->route()->named('customers')
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.sidebar');
    }
}
