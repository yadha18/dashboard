<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class KanalCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public string $name = '', public int $bill = 0, public int $money = 0)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.kanal-card');
    }
}
