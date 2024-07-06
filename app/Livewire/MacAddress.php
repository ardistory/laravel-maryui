<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class MacAddress extends Component
{
    #[Title('Mac-Address')]
    public function render()
    {
        return view('livewire.mac-address');
    }
}
