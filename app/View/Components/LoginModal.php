<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LoginModal extends Component
{
    public string $overlayColor;
    /**
     * Create a new component instance.
     */
    public function __construct(string $overlayColor='bg-black bg-opacity-50')
    {
        $this->overlayColor = $overlayColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.login-modal');
    }
}
