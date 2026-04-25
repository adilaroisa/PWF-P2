<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ActionButton extends Component
{
    public $type;
    public $url;

    /**
     * Membuat instance component baru.
     * * @param string $type (edit atau delete)
     * @param string $url (link tujuan action)
     */
    public function __construct($type, $url)
    {
        $this->type = $type;
        $this->url = $url;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.action-button');
    }
}