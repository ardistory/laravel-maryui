<div>
    <x-header title="Mac-Address" separator progress-indicator />

    <div class="grid grid-cols-12 gap-5">
        <x-card title="Router Board" class="col-span-6 {{ $isLogin ? 'hidden' : '' }}">
            <x-form wire:submit="loginRb" no-separator>
                <x-input label="Login" prefix="RB-951" wire:model="username" />
                <x-input type="password" label="Password" wire:model="password" />

                <x-slot:actions>
                    <x-button label="Connect" class="btn-primary" type="submit" spinner="loginRb" />
                </x-slot:actions>
            </x-form>
        </x-card>
        <x-card title="{{ $isLogin ? 'Sudah Login' : 'Belum Login' }}" class="col-span-6">

        </x-card>
    </div>
</div>
