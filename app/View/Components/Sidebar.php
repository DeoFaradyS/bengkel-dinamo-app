<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Sidebar extends Component
{
    public string $role;

    public function __construct()
    {
        $this->role = auth()->user()->role;
    }

    public function render()
    {
        return view('components.sidebar');
    }
}