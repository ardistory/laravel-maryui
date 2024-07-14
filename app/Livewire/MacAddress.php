<?php

namespace App\Livewire;

use App\Api\RouterosAPI;
use App\Models\TokoLbk;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Livewire\Attributes\Title;
use Livewire\Component;
use Mary\Traits\Toast;

class MacAddress extends Component
{
    use Toast;

    public string $username = '';
    public string $password = '';
    public bool $isLogin = false;
    public array $storageStores = [];
    public string $selectedStore = '';
    public string $mac = '';
    public string $comment = '';

    public function user(): array
    {
        return [env('ROS_USERNAME') => env('ROS_PASSWORD')];
    }

    public function loginRb()
    {
        if (isset($this->user()[$this->username]) && $this->user()[$this->username] === $this->password) {
            $this->isLogin = true;
            $this->success('Login Success!');
        } else {
            $this->reset(['username', 'password']);
            $this->error('Login Failed!');
        }
    }

    public function addMac()
    {
        $routerOs = App::make(RouterosAPI::class);

        if ($this->mac != '') {
            if ($routerOs->connect($this->selectedStore, env('ROS_USERNAME'), env('ROS_PASSWORD'))) {
                $response = $routerOs->comm('/interface/wireless/access-list/print', [
                    '?mac-address' => $this->mac
                ]);

                if (!isset($response[0]['mac-address'])) {
                    $routerOs->comm('/interface/wireless/access-list/add', [
                        'mac-address' => $this->mac,
                        'comment' => $this->comment
                    ]);

                    $this->success('Submit success!', $this->mac);
                    $this->reset('mac');
                } else {
                    $this->error('Mac-address already exists!');
                }
            } else {
                $this->error('Connection to router is failed!');
            }
        } else {
            $this->error('Mac-address cannot be empty!');
        }

    }

    public function listStores(): array
    {
        $tokoLbk = TokoLbk::query()->get(['kode_toko', 'nama_toko', 'ip_wdcp']);

        $tokoLbk->each(function ($value) {
            $this->storageStores[] = [
                'kode_toko' => $value['kode_toko'],
                'kode_nama' => $value['kode_toko'] . " - " . strtoupper($value['nama_toko']),
                'ip_gateway' => $value['ip_wdcp'],
            ];
        });

        return $this->storageStores;
    }

    public function selectIdentity(): array
    {
        return [
            [
                'identity' => 'TOKO'
            ],
            [
                'identity' => 'IC'
            ],
            [
                'identity' => 'PINJAM'
            ]
        ];
    }

    #[Title('Mac-Address')]
    public function render()
    {
        return view('livewire.mac-address', [
            'listStores' => $this->listStores(),
            'selectIdentity' => $this->selectIdentity()
        ]);
    }
}
