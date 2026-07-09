<?php

namespace App\View\Components\Navbar;

use Illuminate\View\Component;

class Dashboard extends Component
{
    public string $name;
    public string $email;

    public function __construct()
    {
        $this->name  = auth()->user()->name;
        $this->email = auth()->user()->email;
    }

    public function render()
    {
        return view('components.navbar.dashboard');
    }
}