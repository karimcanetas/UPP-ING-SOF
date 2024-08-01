<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use App\Models\User;

use Carbon\Carbon;
use DateTime;
use Alert;
use Hash;
use DB;

class AppLayout extends Component
{
    public function render(): View
    {
       
        return view('layouts.app');
    }
}
