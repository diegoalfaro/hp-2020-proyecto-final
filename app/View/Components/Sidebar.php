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
        $this->items = array_map(function($item) {
            return (object) array_merge($item, [
                'active' => request()->route()->named($item['route'])
            ]);
        }, [
            [
                'title' => __('sections.home.title'),
                'icon' => __('sections.home.icon'),
                'route' => __('sections.home.route')
            ],
            [
                'title' => __('sections.orders.title'),
                'icon' => __('sections.orders.icon'),
                'route' => __('sections.orders.route')
            ],
            [
                'title' => __('sections.products.title'),
                'icon' => __('sections.products.icon'),
                'route' => __('sections.products.route')
            ],
            [
                'title' => __('sections.customers.title'),
                'icon' => __('sections.customers.icon'),
                'route' => __('sections.customers.route')
            ]
        ]);

        $this->avatarSrc = 'https://github.com/mdo.png';
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
