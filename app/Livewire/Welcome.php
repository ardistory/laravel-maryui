<?php

namespace App\Livewire;

use App\Models\TokoLbk;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;
use Mary\Traits\Toast;

class Welcome extends Component
{
    use Toast;
    use WithPagination;

    public string $search = '';
    public bool $drawer = false;
    public bool $showDetailIp = false;
    public mixed $detailIp = [];
    public array $sortBy = ['column' => 'kode_toko', 'direction' => 'asc'];

    // Clear filters
    public function clear(): void
    {
        $this->reset();
        $this->resetPage();

        $this->success('Filters cleared.', position: 'toast-bottom');
    }

    // Delete action
    public function delete($kode_toko): void
    {
        $this->warning("Will delete #$kode_toko", 'It is fake.', position: 'toast-bottom');
    }

    public function comingSoon(string $name): void
    {
        $this->error("Coming Soon", "Can't chat with {$name}", position: 'toast-top');
    }

    public function updated($property): void
    {
        if (!is_array($property) && $property != "") {
            $this->resetPage();
        }
    }

    // Table headers
    public function headers(): array
    {
        return [
            ['key' => 'id', 'label' => '#', 'sortable' => false, 'class' => 'w-1 bg-yellow-500/20'],
            ['key' => 'kode_toko', 'label' => 'kode Toko', 'class' => 'w-1'],
            ['key' => 'nama_toko', 'label' => 'Nama Toko', 'class' => 'w-64'],
            ['key' => 'name', 'label' => 'Edp Area', 'class' => 'w-64'],
        ];
    }

    public function headersDetail(): array
    {
        return [
            ['key' => 'kode_toko', 'label' => 'kode Toko', 'class' => 'w-1'],
            ['key' => 'nama_toko', 'label' => 'Nama Toko', 'class' => 'w-64'],
            ['key' => 'ip_gateway', 'label' => 'IP Gateway', 'class' => 'w-64'],
            ['key' => 'ip_induk', 'label' => 'IP Induk', 'class' => 'w-64'],
            ['key' => 'ip_anak', 'label' => 'IP Anak', 'class' => 'w-64'],
            ['key' => 'ip_stb', 'label' => 'IP Stb', 'class' => 'w-64'],
            ['key' => 'ip_wdcp', 'label' => 'IP Wdcp', 'class' => 'w-64'],
        ];
    }

    public function totalStore(): int
    {
        return count(TokoLbk::all());
    }

    public function totalUser(): int
    {
        return count(User::all());
    }

    public function listIp()
    {
        return TokoLbk::query()
            ->when($this->search, function (Builder $builder) {
                return $builder->where('kode_toko', 'like', "%$this->search%")->orWhere('nama_toko', 'like', "%$this->search%");
            })
            ->orderBy(...array_values($this->sortBy))
            ->join('users', 'users.nik', '=', 'tokolbk.edparea')
            ->paginate(7);
    }

    public function proccessDetail(string $kode_toko)
    {

        $this->detailIp = json_decode(TokoLbk::query()->where('kode_toko', '=', $kode_toko)->get(), true);

        $this->showDetailIp = true;

        $this->success('Loaded', position: 'toast-top');
    }

    #[Title('Dashboard')]
    public function render()
    {
        return view('livewire.welcome', [
            'listIp' => $this->listIp(),
            'headers' => $this->headers(),
            'headersDetail' => $this->headersDetail(),
            'totalStore' => $this->totalStore(),
            'totalUser' => $this->totalUser(),
            'users' => User::inRandomOrder()->get()
        ]);
    }
}
