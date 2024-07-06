<div>
    <!-- HEADER -->
    <x-header title="Dashboard" separator progress-indicator>
        <x-slot:middle class="!justify-end">
            <x-input placeholder="Search..." wire:model.live.debounce="search" clearable icon="o-magnifying-glass" />
        </x-slot:middle>
        <x-slot:actions>
            <x-button label="Filters" x-on:click="$wire.drawer = true" responsive icon="o-funnel" class="btn-primary" />
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
            <x-button label="Done" icon="o-check" class="btn-primary" x-on:click="$wire.drawer = false" />
        </x-slot:actions>
    </x-drawer>

    <!-- DETAIL IP DRAWER -->
    <x-drawer wire:model="showDetailIp" class="w-11/12 lg:w-1/3">
        @foreach ($detailIp as $ip)
            <x-list-item :item="$ip">
                <x-slot:value>
                    {{ $ip['kode_toko'] }}
                </x-slot:value>
                <x-slot:sub-value>
                    {{ $ip['nama_toko'] }}
                </x-slot:sub-value>
                <x-slot:actions>
                    <x-button class="copyjs"
                        wire:click="copySuccess('{{ $ip['kode_toko'] . ' - ' . $ip['nama_toko'] }}')"
                        icon="phosphor.copy" tooltip="Copy" spinner
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
                    <x-button label="{{ $resultPing['ip_gateway'] ?? '' }}"
                        wire:click="pingIp('{{ $ip['ip_gateway'] }}','ip_gateway')" icon="phosphor.cell-signal-full"
                        tooltip="Ping" spinner />
                    <x-button class="copyjs" wire:click="copySuccess('{{ $ip['ip_gateway'] }}')" icon="phosphor.copy"
                        tooltip="Copy" spinner data-clipboard-text="{{ $ip['ip_gateway'] }}" />
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
                    <x-button label="{{ $resultPing['ip_induk'] ?? '' }}"
                        wire:click="pingIp('{{ $ip['ip_induk'] }}','ip_induk')" icon="phosphor.cell-signal-full"
                        tooltip="Ping" spinner />
                    <x-button class="copyjs" wire:click="copySuccess('{{ $ip['ip_induk'] }}')" icon="phosphor.copy"
                        tooltip="Copy" spinner data-clipboard-text="{{ $ip['ip_induk'] }}" />
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
                    <x-button label="{{ $resultPing['ip_anak'] ?? '' }}"
                        wire:click="pingIp('{{ $ip['ip_anak'] }}','ip_anak')" icon="phosphor.cell-signal-full"
                        tooltip="Ping" spinner />
                    <x-button class="copyjs" wire:click="copySuccess('{{ $ip['ip_anak'] }}')" icon="phosphor.copy"
                        tooltip="Copy" spinner data-clipboard-text="{{ $ip['ip_anak'] }}" />
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
                    <x-button label="{{ $resultPing['ip_stb'] ?? '' }}"
                        wire:click="pingIp('{{ $ip['ip_stb'] }}','ip_stb')" icon="phosphor.cell-signal-full"
                        tooltip="Ping" spinner />
                    <x-button class="copyjs" wire:click="copySuccess('{{ $ip['ip_stb'] }}')" icon="phosphor.copy"
                        tooltip="Copy" spinner data-clipboard-text="{{ $ip['ip_stb'] }}" />
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
                    <x-button label="{{ $resultPing['ip_wdcp'] ?? '' }}"
                        wire:click="pingIp('{{ $ip['ip_wdcp'] }}','ip_wdcp')" icon="phosphor.cell-signal-full"
                        tooltip="Ping" spinner />
                    <x-button class="copyjs" wire:click="copySuccess('{{ $ip['ip_wdcp'] }}')" icon="phosphor.copy"
                        tooltip="Copy" spinner data-clipboard-text="{{ $ip['ip_wdcp'] }}" />
                </x-slot:actions>
            </x-list-item>
        @endforeach
    </x-drawer>
</div>
