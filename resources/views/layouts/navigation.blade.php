<nav class="bg-white shadow z-40 sticky top-0" x-data="{ open: false, profile: false }" x-cloak>
    <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
        <div class="flex justify-between h-14">
            <div class="flex px-2 lg:px-0">
                <a href="{{ route('home') }}" class='flex items-center space-x-2'>
                    <div class="h-6 w-6 md:h-8 md:w-8">
                        <img src="{{ asset('img/logo.png') }}" alt="CFBP" />
                    </div>
                    <div class="flex text-lg md:text-2xl font-light text-indigo-600">CFBP</div>
                </a>
                <div class="hidden lg:ml-6 lg:flex lg:space-x-4">
                    <!-- Navigation Links -->
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Home') }}
                    </x-nav-link>
                    <x-nav-link :href="route('games')" :active="request()->routeIs('games') || request()->routeIs('game')">
                        {{ __('Scoreboard') }}
                    </x-nav-link>
                    {{-- <x-nav-link :href="route('standings')" :active="request()->routeIs('standings')">
                        {{ __('Standings') }}
                    </x-nav-link> --}}
                    <x-nav-link :href="route('rankings')" :active="request()->routeIs('rankings')">
                        {{ __('Rankings') }}
                    </x-nav-link>
                    <x-nav-link :href="route('teams')" :active="request()->routeIs('teams')">
                        {{ __('Teams') }}
                    </x-nav-link>
                    @admin
                    <x-nav-link :href="route('feeds')" :active="request()->routeIs('feeds')">
                        {{ __('Feeds') }}
                    </x-nav-link>
                    @endadmin
                </div>
            </div>
            <div id="app" class="flex-1 flex items-center justify-center px-2 lg:ml-6 lg:justify-end">
                <div class="max-w-lg w-full lg:max-w-xs">
                    <search></search>
                </div>
            </div>
            <div class="flex items-center lg:hidden">
                <!-- Mobile menu button -->
                <button type="button" @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                    aria-controls="mobile-menu" aria-expanded="false">

                    <span class="sr-only">Open main menu</span>

                    <!-- Hamburger when closed -->
                    <x-heroicon-o-bars-3 x-show="!open" class="inline-flex h-6 w-6" />
                    <!-- X when open -->
                    <x-heroicon-o-x-mark x-show="open" class="inline-flex h-6 w-6" />

                </button>
            </div>
            <div class="hidden lg:ml-4 lg:flex lg:items-center">
                @auth
                    <button type="button"
                        class="flex-shrink-0 bg-white p-1 text-gray-400 rounded-full hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <span class="sr-only">View notifications</span>
                        <!-- Heroicon name: outline/bell -->
                        <x-heroicon-s-bell class="w-5 h-5 text-gray-500" />
                    </button>

                    <!-- Profile dropdown -->
                    <div class="ml-4 relative flex-shrink-0">
                        <div>
                            <button type="button" @click="profile = !profile"
                                class="bg-white rounded-full flex text-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                                <span class="sr-only">Open user menu</span>
                                <x-heroicon-o-user-circle class="w-6 h-6 text-gray-500" />
                            </button>
                        </div>
                        {{-- <template x-if="profile"> --}}
                            <div x-show="profile" @click.away="profile = !profile"
                                class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
                                role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
                                <div class="flex flex-col px-4 py-2 border-b border-gray-200">
                                    <div class="font-medium text-sm text-gray-800">{{ Auth::user()->name }}</div>
                                    <div class="font-medium text-xs text-gray-500">{{ Auth::user()->email }}</div>
                                </div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </div>
                        {{-- </template> --}}
                    </div>
                @else
                    <div class="hidden sm:flex sm:items-center space-x-2">
                        <x-button link="{{ route('login') }}" color="blue" size="sm">Log In</x-button>
                        <x-button link="{{ route('register') }}" color="blue" size="sm" outline>Create Account
                        </x-button>
                    </div>
                @endauth
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div :class="{'block': open, 'hidden': ! open}" class="lg:hidden" id="mobile-menu">
        @auth
            <!-- Responsive Settings Options -->
            <div class="flex items-center justify-between pt-4 pb-1 pl-4 pr-6 border-t border-gray-200">

                <div class="flex flex-col">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="flex">
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-button color="red" onclick="event.preventDefault();this.closest('form').submit();">Log Out
                        </x-button>
                    </form>
                </div>

            </div>
        @else
            <div class="mt-2 mb-4 flex items-center justify-center space-x-4">
                <x-button link="{{ route('login') }}" color="blue">Log In</x-button>
                <x-button link="{{ route('register') }}" color="blue" outline>Create Account</x-button>
            </div>
        @endauth

        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Home') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('games')" :active="request()->routeIs('games') || request()->routeIs('game')">
                {{ __('Scoreboard') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('rankings')" :active="request()->routeIs('rankings')">
                {{ __('Rankings') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('teams')" :active="request()->routeIs('teams')">
                {{ __('Teams') }}
            </x-responsive-nav-link>
            @admin
            <x-responsive-nav-link :href="route('feeds')" :active="request()->routeIs('feeds')">
                {{ __('Feeds') }}
            </x-responsive-nav-link>
            @endadmin
        </div>
    </div>
</nav>