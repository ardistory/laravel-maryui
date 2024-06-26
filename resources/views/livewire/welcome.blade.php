<div>
    <!-- HEADER -->
    <x-header title="IP ADDRESS" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <div class="mb-5 flex gap-5">
        <x-stat title="Total" description="Store" value="{{ $totalStore }}" icon="phosphor.storefront"
            tooltip-bottom="Total Store" />
        <x-stat title="Total" description="Users" value="{{ $totalUser }}" icon="phosphor.users-three"
            tooltip-bottom="Total Users" />
    </div>

    @if (count($listIp) > 0)
        <x-card>
            <x-table :headers="$headers" :rows="$listIp" :sort-by="$sortBy"
                @row-click="$wire.proccessDetail($event.detail.kode_toko)" with-pagination>
                @scope('cell_id', $list)
                    {{ $loop->index + 1 }}
                @endscope

                @scope('actions', $list)
                    <x-button icon="phosphor.eye" wire:click='proccessDetail("{{ $list->kode_toko }}")' spinner
                        class="btn-ghost btn-sm" />
                @endscope
            </x-table>
        </x-card>
    @else
        <x-alert title="Nothing here!" description="Try to remove some filters." icon="o-exclamation-triangle"
            class="bg-base-100 border-none">
            <x-slot:actions>
                <x-button label="Clear filters" wire:click="clear" icon="o-x-mark" spinner />
            </x-slot:actions>
        </x-alert>
    @endif
    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass"
            @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>

    <x-modal wire:model="showDetailIp" title="Detail" subtitle="IP Address" class="w-full" separator>
        <x-table :headers="$headersDetail" :rows="$detailIp" striped />

        <x-slot:actions>
            <x-button label="Confirm" @click="$wire.showDetailIp = false" class="btn-primary" />
        </x-slot:actions>
    </x-modal>
</div>
