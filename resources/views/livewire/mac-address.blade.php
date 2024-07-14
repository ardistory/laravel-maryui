<div>
    <x-header title="Mac-Address" separator progress-indicator />

    <div class="grid grid-cols-12 gap-5">
        {{-- <x-card title="Router Board" class="col-span-12 md:col-span-6 {{ $isLogin ? 'hidden' : '' }}">
            <x-form wire:submit="loginRb" no-separator>
                <x-input label="Login" prefix="RB-951" wire:model="username" />
                <x-input type="password" label="Password" wire:model="password" />

                <x-slot:actions>
                    <x-button label="Connect" class="btn-primary" type="submit" spinner="loginRb" />
                </x-slot:actions>
            </x-form>
        </x-card> --}}
        <x-card class="col-span-12 md:col-span-6 {{ $isLogin ? 'hidden' : '' }}">
            <x-form wire:submit='addMac' no-separator>
                <x-select :options="$listStores" option-value="ip_gateway" option-label="kode_nama" placeholder="Select a store"
                    wire:model="selectedStore">
                </x-select>
                <x-input wire:model="mac" placeholder="Mac-Address" class="mt-1" />
                <x-select :options="$selectIdentity" option-value="identity" option-label="identity"
                    placeholder="Select a identity" wire:model="comment" class="mt-1" />
                <x-slot:actions>
                    <x-button label="Submit" class="btn-primary" type="submit" spinner="addMac" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>
