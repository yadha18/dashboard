<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardContainer extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public int $total = 0, public int $total_kanal = 0)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-container');
    }
}
