<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLogo extends Component
{
    public string $variant;
    /**
     * Create a new component instance.
     */
    public function __construct(string $variant = 'red')
    {
        $this->variant = $variant;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-logo');
    }
}
