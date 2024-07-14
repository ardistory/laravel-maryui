<div>
    <x-header title="Mac-Address" separator progress-indicator />

    <div class="grid grid-cols-12 md:grid-rows-5 gap-5">
        {{-- <x-card title="Router Board" class="col-span-12 md:row-span-5 md:col-span-6 {{ $isLogin ? 'hidden' : '' }}">
            <x-form wire:submit="loginRb" no-separator>
                <x-input label="Login" prefix="RB-951" wire:model="username" />
                <x-input type="password" label="Password" wire:model="password" />

                <x-slot:actions>
                    <x-button label="Connect" class="btn-primary" type="submit" spinner="loginRb" />
                </x-slot:actions>
            </x-form>
        </x-card> --}}
        <x-card class="col-span-12 md:row-span-6 md:col-span-6 {{ $isLogin ? 'hidden' : '' }}">
            <x-form wire:submit='addMac' no-separator>
                <x-select :options="$listStores" icon="phosphor.storefront" option-value="ip_gateway" option-label="kode_nama"
                    placeholder="Select a store" wire:model.live="selectedStore">
                </x-select>
                <x-input wire:model="mac" prefix="Mac-Address" label="Example: F1:F2:F3:F4:F5:F6" inline />
                <x-select :options="$selectIdentity" option-value="identity" option-label="identity"
                    placeholder="Select a identity" wire:model="comment" />
                <x-slot:actions>
                    <x-button label="Reset" wire:click='resetForm' spiner='resetForm' />
                    <x-button label="Submit" class="btn-primary" type="submit" spinner="addMac" />
                </x-slot:actions>
            </x-form>
        </x-card>
        <x-card class="col-span-12 md:row-span-6 md:col-span-6 {{ $isLogin ? 'hidden' : '' }}">
            <x-form wire:submit="save" no-separator>
                <x-input label="Get Default-Authentication" value="False" disabled />
                <x-radio label="Set Default-Authentication" :options="$setDefault" option-value="value" option-label="label"
                    wire:model="selectedDefault" />
                <x-input label="Registration-Table" value="04:E5:98:21:98:D8" readonly>
                    <x-slot:append>
                        <x-button label="Refresh" icon="phosphor.arrows-clockwise" class="btn-primary rounded-s-none" />
                    </x-slot:append>
                </x-input>
            </x-form>
        </x-card>
    </div>
</div>
