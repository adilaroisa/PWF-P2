<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AddProduct extends Component
{
    public $url;
    public $name;

    public function __construct($url, $name)
    {
        $this->url = $url;
        $this->name = $name;
    }

    public function render()
    {
        return view('components.add-product');
    }
}