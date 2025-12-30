<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FloatingAsset extends Component
{
    public $class;
    public $svg;
    
    public function __construct($class, $svg)
    {
        $this->class = $class;
        $this->svg = $svg;
    }
    
    public function render()
    {
        return view('components.floating-asset');
    }
}