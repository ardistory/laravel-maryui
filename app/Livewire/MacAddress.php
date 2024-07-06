<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;
use Mary\Traits\Toast;

class MacAddress extends Component
{
    use Toast;

    public string $username = '';
    public string $password = '';
    public bool $isLogin = false;

    public function user(): array
    {
        return ['wdcp' => 'xlybzk'];
    }

    public function loginRb()
    {
        $this->isLogin = true;
        $this->success('Login Success!');
    }

    #[Title('Mac-Address')]
    public function render()
    {
        return view('livewire.mac-address');
    }
}
