<div>
    <x-header title="Mac-Address" separator progress-indicator />

    <div class="grid grid-cols-12 gap-5">
        <x-card title="Router Board" class="col-span-6">
            <x-form wire:submit="save" no-separator>
                <x-input label="Login" prefix="RB-951" wire:model="name" />
                <x-input label="Password" wire:model="name" />

                <x-slot:actions>
                    <x-button label="Connect" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
        <x-card title="Router Board" class="col-span-6">
            <x-form wire:submit="save" no-separator>
                <x-input label="Login" prefix="RB-951" wire:model="name" />
                <x-input label="Password" wire:model="name" />

                <x-slot:actions>
                    <x-button label="Connect" class="btn-primary" type="submit" spinner="save" />
                </x-slot:actions>
            </x-form>
        </x-card>
    </div>
</div>
