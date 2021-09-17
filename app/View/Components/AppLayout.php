<?php

namespace App\View\Components;

use Illuminate\View\Component;

class AppLayout extends Component
{
    public $reset;
    public function __construct($reset = 1)
    {
        $this->reset = $reset;
    }
    public function render()
    {
        return view('layouts.app');
    }
}
