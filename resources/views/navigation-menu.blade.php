<nav x-data="{ open: false }"
    class="bg-zinc-50 dark:bg-zinc-900 border-b border-zinc-200 dark:border-zinc-700 sticky top-0 z-50">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" wire:navigate>
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('aws-accounts') }}" :active="request()->routeIs('aws-accounts')" wire:navigate>
                        {{ __('AWS Accounts') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">


                <!-- Teams Dropdown -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="ms-3 relative">
                        <flux:dropdown x-data align="end">
                            <flux:button variant="subtle" icon-trailing="chevron-up-down"
                                aria-label="Preferred color scheme">
                                {{ Auth::user()->currentTeam->name }}
                            </flux:button>
                            <flux:menu>
                                <!-- Account Management -->
                                <div class="block px-2 py-2 text-xs text-gray-400">
                                    {{ auth()->user()->currentTeam->name }}
                                </div>
                                <flux:menu.item icon="cog"
                                    href="{{ route('teams.show', Auth::user()->currentTeam->id) }}" wire:navigate>
                                    {{ __('Settings') }}</flux:menu.item>
                                <flux:menu.item icon="document-currency-dollar" href="{{ route('invoices') }}"
                                    wire:navigate>{{ __('Invoices') }}</flux:menu.item>
                                <flux:menu.item icon="banknotes" href="{{ route('payment-details') }}" wire:navigate>
                                    {{ __('Payments') }}</flux:menu.item>

                                {{--                                @can('create', Laravel\Jetstream\Jetstream::newTeamModel()) --}}
                                {{--                                    <flux:menu.item icon="plus" href="{{ route('teams.create') }}" --}}
                                {{--                                                    wire:navigate>{{ __('Create New') }}</flux:menu.item> --}}
                                {{--                                @endcan --}}
                                @if (Auth::user()->allTeams()->count() > 1)
                                    <flux:separator class="my-1 mt-2" />
                                    <div class="block px-2 py-2 text-xs text-gray-400">
                                        {{ __('Switch Organisation') }}
                                    </div>
                                    @foreach (Auth::user()->allTeams() as $team)
                                        <x-switchable-team component="team-link" :team="$team" />
                                    @endforeach
                                @endif
                            </flux:menu>
                        </flux:dropdown>


                    </div>
                @endif

                <flux:separator vertical class="my-4 mx-3" />
                <flux:dropdown x-data align="end">
                    <flux:button variant="subtle" square class="group" aria-label="Preferred color scheme">
                        <flux:icon.sun x-show="$flux.appearance === 'light'" variant="mini"
                            class="text-zinc-500 dark:text-white" />
                        <flux:icon.moon x-show="$flux.appearance === 'dark'" variant="mini"
                            class="text-zinc-500 dark:text-white" />
                        <flux:icon.moon x-show="$flux.appearance === 'system' && $flux.dark" variant="mini" />
                        <flux:icon.sun x-show="$flux.appearance === 'system' && ! $flux.dark" variant="mini" />
                    </flux:button>

                    <flux:menu>
                        <flux:menu.item icon="sun" x-on:click="$flux.appearance = 'light'">Light</flux:menu.item>
                        <flux:menu.item icon="moon" x-on:click="$flux.appearance = 'dark'">Dark</flux:menu.item>
                        <flux:menu.item icon="computer-desktop" x-on:click="$flux.appearance = 'system'">System
                        </flux:menu.item>
                    </flux:menu>
                </flux:dropdown>
                <!-- Settings Dropdown -->
                <div class="ms-3 relative">

                    <flux:dropdown x-data align="end">
                        <flux:profile avatar="{{ Auth::user()->profile_photo_url }}" />
                        <flux:menu>
                            <div class="block px-2 pt-2 text-xs text-gray-400">
                                {{ __('Signed in as') }}
                            </div>

                            <flux:subheading class="truncate px-2">{{ Auth::user()->email }}</flux:subheading>
                            <flux:separator class="my-1 mt-2" />
                            <!-- Account Management -->
                            <div class="block px-2 py-2 text-xs text-gray-400">
                                {{ __('Manage Account') }}
                            </div>
                            <flux:menu.item icon="user" href="{{ route('profile.show') }}" wire:navigate>
                                {{ __('Profile') }}</flux:menu.item>
                            <flux:separator class="my-1" />
                            <form method="POST" action="{{ route('logout') }}" x-data>
                                @csrf

                                <flux:menu.item icon="arrow-right-end-on-rectangle" href="{{ route('logout') }}"
                                    @click.prevent="$root.submit();" wire:navigate>
                                    {{ __('Log Out') }}
                                </flux:menu.item>
                            </form>
                        </flux:menu>
                    </flux:dropdown>
                </div>
            </div>

            <!-- Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="size-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="flex items-center px-4">
                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <div class="shrink-0 me-3">
                        <img class="size-10 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </div>
                @endif

                <div>
                    <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>
            </div>

            <div class="mt-3 space-y-1">
                <!-- Account Management -->
                <x-responsive-nav-link href="{{ route('profile.show') }}" :active="request()->routeIs('profile.show')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                @if (Laravel\Jetstream\Jetstream::hasApiFeatures())
                    <x-responsive-nav-link href="{{ route('api-tokens.index') }}" :active="request()->routeIs('api-tokens.index')">
                        {{ __('API Tokens') }}
                    </x-responsive-nav-link>
                @endif

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf

                    <x-responsive-nav-link href="{{ route('logout') }}" @click.prevent="$root.submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>

                <!-- Team Management -->
                @if (Laravel\Jetstream\Jetstream::hasTeamFeatures())
                    <div class="border-t border-gray-200 dark:border-gray-600"></div>

                    <div class="block px-4 py-2 text-xs text-gray-400">
                        {{ __('Manage Team') }}
                    </div>

                    <!-- Team Settings -->
                    <x-responsive-nav-link href="{{ route('teams.show', Auth::user()->currentTeam->id) }}"
                        :active="request()->routeIs('teams.show')">
                        {{ __('Team Settings') }}
                    </x-responsive-nav-link>

                    @can('create', Laravel\Jetstream\Jetstream::newTeamModel())
                        <x-responsive-nav-link href="{{ route('teams.create') }}" :active="request()->routeIs('teams.create')">
                            {{ __('Create New Team') }}
                        </x-responsive-nav-link>
                    @endcan

                    <!-- Team Switcher -->
                    @if (Auth::user()->allTeams()->count() > 1)
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>

                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('Switch Teams') }}
                        </div>

                        @foreach (Auth::user()->allTeams() as $team)
                            <x-switchable-team :team="$team" component="responsive-nav-link" />
                        @endforeach
                    @endif
                @endif
            </div>
        </div>
    </div>
</nav>
