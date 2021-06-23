<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextArea extends Component
{
    public $label, $name, $value;
    
    public function __construct($label, $name, $value = '')
    {
        $this->label = $label;
        $this->name = $name;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.text-area');
    }
}
