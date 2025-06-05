<?php

namespace App\View\Components;

use App\Models\Plataforma;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class menuPlataformas extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $urlUser=Auth::user()->plataformas;
        $urlPublic=Plataforma::activas()->publicas()->get()->merge($urlUser)->take(4);
        return view('components.menu-plataformas',compact('urlPublic'));
    }
}
