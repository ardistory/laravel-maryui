<?php

namespace App\Livewire;

use App\Models\TokoLbk;
use Illuminate\Database\Eloquent\Collection;
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
        if (isset($this->user()[$this->username]) && $this->user()[$this->username] == $this->password) {
            $this->isLogin = true;
            $this->success('Login Success!');


        } else {
            $this->reset(['username', 'password']);
            $this->error('Login Failed!');
        }
    }

    public function listStores(): array|Collection
    {
        return TokoLbk::query()->get(['kode_toko', 'nama_toko', 'ip_wdcp']);
    }

    #[Title('Mac-Address')]
    public function render()
    {
        return view('livewire.mac-address');
    }
}
