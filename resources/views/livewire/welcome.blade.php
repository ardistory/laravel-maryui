<div>
    <!-- HEADER -->
    <x-header title="Dashboard" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" @click="$wire.drawer = true" responsive icon="o-funnel" class="btn-primary" />
        </x-slot:actions>
    </x-header>

    <div class="mb-5 flex gap-5">
        <x-stat title="Total Store" value="{{ $totalStore }}" icon="phosphor.storefront"
            tooltip-bottom="Total Store" />
        <x-stat title="Total Users" value="{{ $totalUser }}" icon="phosphor.users-three"
            tooltip-bottom="Total Users" />
    </div>

    @if (count($listIp) > 0)
        <x-card title="Data Stores">
            <x-table :headers="$headers" :rows="$listIp" :sort-by="$sortBy"
                @row-click="$wire.proccessDetail($event.detail.kode_toko)" with-pagination>
                @scope('cell_id', $list)
                    {{ $loop->index + 1 }}
                @endscope

                @scope('cell_name', $list)
                    @if ($list['name'] != 'Ardiansyah Putra')
                        {{ $list['name'] }}
                    @else
                        <p class="bg-red-500 text-white inline-block px-2">?</p>
                    @endif
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

    <x-card title="Users" class="mt-5">
        @foreach ($users as $user)
            <x-list-item :item="$user" value="name" avatar="picture">
                <x-slot:avatar>
                    <div class="py-3">
                        <div class="avatar">
                            <div class="w-11 rounded-full">
                                <img src="{{ asset('storage/' . $user->picture) }}" />
                            </div>
                        </div>
                    </div>
                </x-slot:avatar>
                <x-slot:value>
                    @if ($user->nik == '2015171331')
                        {{ $user->name }}<x-icon name="phosphor.seal-check-fill" class="text-sky-500" />
                    @else
                        {{ $user->name }}
                    @endif
                </x-slot:value>
                <x-slot:sub-value>
                    {{ $user->nik }}
                </x-slot:sub-value>
                <x-slot:actions>
                    <x-button icon="phosphor.chat-circle-dots" wire:click="comingSoon('{{ $user->name }}')" spinner />
                </x-slot:actions>
            </x-list-item>
        @endforeach
    </x-card>

    <!-- FILTER DRAWER -->
    <x-drawer wire:model="drawer" title="Filters" right separator with-close-button class="lg:w-1/3">
        <x-input placeholder="Search..." wire:model.live.debounce="search" icon="o-magnifying-glass"
            @keydown.enter="$wire.drawer = false" />

        <x-slot:actions>
            <x-button label="Reset" icon="o-x-mark" wire:click="clear" spinner />
            <x-button label="Done" icon="o-check" class="btn-primary" @click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>

    <x-modal wire:model="showDetailIp" class="backdrop-blur">
        @foreach ($detailIp as $ip)
            <x-list-item :item="$ip">
                <x-slot:value>
                    {{ $ip['kode_toko'] }}
                </x-slot:value>
                <x-slot:sub-value>
                    {{ $ip['nama_toko'] }}
                </x-slot:sub-value>
                <x-slot:actions>
                    <x-button icon="phosphor.copy" tooltip="Copy" spinner
                        data-clipboard-text="{{ $ip['kode_toko'] . ' - ' . $ip['nama_toko'] }}" />
                </x-slot:actions>
            </x-list-item>
            <x-list-item :item="$ip">
                <x-slot:value>
                    IP GATEWAY
                </x-slot:value>
                <x-slot:sub-value>
                    {{ $ip['ip_gateway'] }}
                </x-slot:sub-value>
                <x-slot:actions>
                    <x-button icon="phosphor.cell-signal-full" tooltip="Ping" spinner />
                    <x-button icon="phosphor.copy" tooltip="Copy" spinner
                        data-clipboard-text="{{ $ip['ip_gateway'] }}" />
                </x-slot:actions>
            </x-list-item>
            <x-list-item :item="$ip">
                <x-slot:value>
                    IP INDUK
                </x-slot:value>
                <x-slot:sub-value>
                    {{ $ip['ip_induk'] }}
                </x-slot:sub-value>
                <x-slot:actions>
                    <x-button icon="phosphor.cell-signal-full" tooltip="Ping" spinner />
                    <x-button icon="phosphor.copy" tooltip="Copy" spinner
                        data-clipboard-text="{{ $ip['ip_induk'] }}" />
                </x-slot:actions>
            </x-list-item>
            <x-list-item :item="$ip">
                <x-slot:value>
                    IP ANAK
                </x-slot:value>
                <x-slot:sub-value>
                    {{ $ip['ip_anak'] }}
                </x-slot:sub-value>
                <x-slot:actions>
                    <x-button icon="phosphor.cell-signal-full" tooltip="Ping" spinner />
                    <x-button icon="phosphor.copy" tooltip="Copy" spinner data-clipboard-text="{{ $ip['ip_anak'] }}" />
                </x-slot:actions>
            </x-list-item>
            <x-list-item :item="$ip">
                <x-slot:value>
                    IP STB
                </x-slot:value>
                <x-slot:sub-value>
                    {{ $ip['ip_stb'] }}
                </x-slot:sub-value>
                <x-slot:actions>
                    <x-button icon="phosphor.cell-signal-full" tooltip="Ping" spinner />
                    <x-button icon="phosphor.copy" tooltip="Copy" spinner data-clipboard-text="{{ $ip['ip_stb'] }}" />
                </x-slot:actions>
            </x-list-item>
            <x-list-item :item="$ip">
                <x-slot:value>
                    IP WDCP
                </x-slot:value>
                <x-slot:sub-value>
                    {{ $ip['ip_wdcp'] }}
                </x-slot:sub-value>
                <x-slot:actions>
                    <x-button icon="phosphor.cell-signal-full" tooltip="Ping" spinner />
                    <x-button icon="phosphor.copy" tooltip="Copy" spinner data-clipboard-text="{{ $ip['ip_wdcp'] }}" />
                </x-slot:actions>
            </x-list-item>
        @endforeach

        <x-slot:actions>
            <x-button class="btn-primary btn-sm" label="Confirm" @click="$wire.showDetailIp = false" />
        </x-slot:actions>
    </x-modal>
</div>
