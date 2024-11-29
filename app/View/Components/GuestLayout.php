<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

use Alert;
use Hash;
use DB;

class GuestLayout extends Component
{
    public function render(): View {
        $tema = [];

        return view('layouts.guest', compact('tema'));
    }
}
