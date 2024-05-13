<nav class="sidebar">
    <div class="sidebar-inner">
        <header class="sidebar-header">
            <button
                type="button"
                class="sidebar-burger"
                onclick="toggleSidebar()"
            ></button>
            <x-application-logo class="sidebar-logo"></x-application-logo>
            <span>Gruppe Sechs</span>
        </header>
        <nav class="sidebar-menu">
            <a href="{{route('dashboard')}}">
                <img src="{{asset('assets/icon-dashboard.svg')}}" />
                <span>Tableau de bord</span>
            </a>
            <a href="{{route('profile.edit', ['id' => auth()->user()->id])}}" class="has-border">
                <img src="{{ Auth::user()->getAvatar(['extension' => 'webp', 'size' => 32]) }}" alt="{{ Auth::user()->getTagAttribute() }}" />
                <span>{{ Auth::user()->getTagAttribute() }}</span>
            </a>
            <a href="{{route('timer')}}">
                <img src="{{asset('assets/icon-duty.svg')}}" />
                <span>Prise de service</span>
            </a>
            <a href="{{route('convoy.index')}}" class="has-border">
                <img src="{{asset('assets/icon-convoy.svg')}}" />
                <span>Convois</span>
            </a>
            @can('manage', \App\Models\DiscordRole::class)
            <a href="{{route('roles.index')}}">
                <img src="{{asset('assets/icon-role.svg')}}" />
                <span>Voir les rôles</span>
            </a>
            @endif
            @can('manage', \App\Models\DiscordRole::class)
                <a href="{{route('list-users')}}">
                    <img src="{{asset('assets/icon-users.svg')}}">
                    <span>Liste des agents</span>
                </a>
            @endcan
            @can('manage', \App\Models\DiscordRole::class)
                <a href="{{route('vehicles.index')}}">
                    <img src="{{asset('assets/icon-vehicles.svg')}}" />
                    <span>Gestion des véhicules</span>
                </a>
            @endif
            @can('manage', \App\Models\DiscordRole::class)
            <a href="{{route('webhook')}}" class="has-border">
                <img src="{{asset('assets/icon-webhook.svg')}}" />
                <span>Gestion des webhooks</span>
            </a>
            @endif
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{route('logout')}}" onclick="event.preventDefault(); this.closest('form').submit();">
                    <img src="{{asset('assets/icon-logout.svg')}}" />
                    <span>Déconnexion</span>
                </a>
            </form>
        </nav>
    </div>
</nav>

{{--
<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800 dark:text-gray-200"/>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('timer')" :active="request()->routeIs('timer')">Prise de service
                    </x-nav-link>
                    <x-nav-link :href="route('convoy.index')" :active="request()->routeIs('convoy.index')">Convois
                    </x-nav-link>
                    <x-nav-link :href="route('roles.index')" :active="request()->routeIs('roles.index')">Voir les
                        rôles
                    </x-nav-link>
                    <x-nav-link :href="route('webhook')" :active="request()->routeIs('webhook')">Gestion des webhooks
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button
                            class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                            <img class="h-8 w-8 rounded-full object-cover mr-2"
                                 src="{{ Auth::user()->getAvatar(['extension' => 'webp', 'size' => 32]) }}"
                                 alt="{{ Auth::user()->getTagAttribute() }}"/>

                            <div style="display: flex; flex-direction: column; align-items: flex-start;">
                                {{ Auth::user()->getTagAttribute() }}
                                @if (Auth::user()->global_name)
                                <small>{{ Auth::user()->username }}</small>
                                @endif
                            </div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                     viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open"
                        class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex"
                              stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                              stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>--}}
