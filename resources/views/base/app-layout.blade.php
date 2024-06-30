<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? config('app.name') . ' | ' . $title : config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">

    {{-- The navbar with `sticky` and `full-width` --}}
    <x-nav sticky full-width>

        <x-slot:brand>
            {{-- Drawer toggle for "main-drawer" --}}
            <label for="main-drawer" class="lg:hidden mr-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>

            {{-- Brand --}}
            <x-button label="Laravel" badge="v{{ Illuminate\Foundation\Application::VERSION }}"
                badge-classes="badge-warning" />
        </x-slot:brand>

        {{-- Right side actions --}}
        <x-slot:actions>
            <x-button label="Messages" icon="o-envelope" link="###" class="btn-ghost btn-sm" responsive />
            <x-button label="Notifications" icon="o-bell" link="###" class="btn-ghost btn-sm" responsive />
            <x-theme-toggle class="btn btn-circle btn-ghost" />
        </x-slot:actions>
    </x-nav>

    {{-- The main content with `full-width` --}}
    <x-main with-nav full-width>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">
            {{-- User --}}
            @if ($user = auth()->user())
                <x-menu-separator />

                <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover
                    class="-mx-2 !-my-2 rounded">
                    <x-slot:actions>
                        <x-button icon="o-power" class="btn-circle btn-ghost btn-xs" tooltip-left="logoff"
                            no-wire-navigate link="/logout" />
                    </x-slot:actions>
                </x-list-item>

                <x-menu-separator />
            @endif

            {{-- MENU --}}
            <x-menu activate-by-route>
                <x-menu-item title="Dashboard" icon="phosphor.speedometer" link="{{ route('welcome') }}" />
                <x-menu-sub title="Networking" icon="phosphor.wifi-high" open>
                    <x-menu-item title="Mac-Address" icon="phosphor.barcode" />
                    <x-menu-item title="Scan WDCP Y" icon="phosphor.file-magnifying-glass" />
                </x-menu-sub>
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}
        </x-slot:content>
    </x-main>

    {{-- Toast --}}
    <x-toast />
</body>

</html>
