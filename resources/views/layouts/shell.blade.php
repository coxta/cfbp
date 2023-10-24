<div x-data="{ mobile: false, profile: false }">
    <div 
        x-show="mobile"
        class="relative z-50 lg:hidden" 
        role="dialog" 
        aria-modal="true">
      <div 
        x-show="mobile"
        x-transition:enter="transition-opacity ease-linear duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-linear duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 bg-gray-900/80"></div>
  
      <div class="fixed inset-0 flex">
        <div 
            x-show="mobile"
            x-transition:enter="transition ease-in-out duration-300 transform"
            x-transition:enter-start="-translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition ease-in-out duration-300 transform"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="-translate-x-full"
            class="relative mr-16 flex w-full max-w-xs flex-1">
          <div 
            x-show="mobile"
            x-transition:enter="ease-in-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="ease-in-out duration-300"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="absolute left-full top-0 flex w-16 justify-center pt-5">
            <button @click="mobile = !mobile" type="button" class="-m-2.5 p-2.5">
              <span class="sr-only">Close sidebar</span>
              <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
              </svg>
            </button>
          </div>
  
          <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4">

            <a href="{{ route('home') }}" class="flex h-16 shrink-0 items-center space-x-2">
                <div class="h-6 w-6 md:h-8 md:w-8">
                    <img src="{{ asset('img/logo.png') }}" alt="CFBP" />
                </div>
                <div class="flex text-lg md:text-2xl font-light text-indigo-600">CFBP</div>
            </a>

            <nav class="flex flex-1 flex-col">
              <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                    <div class="text-xs leading-6 text-muted">NCAA Football</div>
                    <ul role="list" class="ml-0.5 space-y-1">
                        <li>
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                <img src="{{ secure_asset('img/pick.svg') }}" class="h-5 w-5"/>
                                {{ __('Home') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('games')" :active="request()->routeIs('games') || request()->routeIs('game')">
                                <img src="{{ secure_asset('img/nav-icons/scoreboard.svg') }}" class="h-5 w-5"/>
                                {{ __('Scoreboard') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('rankings')" :active="request()->routeIs('rankings')">
                                <img src="{{ secure_asset('img/nav-icons/rankings.svg') }}" class="h-5 w-5"/>
                                {{ __('Rankings') }}
                            </x-nav-link>
                        </li>
                        <li>
                            <x-nav-link :href="route('teams')" :active="request()->routeIs('teams') || request()->routeIs('team')">
                                <img src="{{ secure_asset('img/nav-icons/teams.svg') }}" class="h-6 w-6"/>
                                {{ __('Teams') }}
                            </x-nav-link>
                        </li>
                        @foreach(auth()->user()->favorites() as $team)
                        <li class="pl-2.5">
                            <a href="{{ route('team', $team->id ) }}" class="flex flex-row cursor-pointer hover:font-semibold items-center text-dark group flex gap-x-3 p-2 text-sm">
                                <x-bi-arrow-return-right class="w-4 h-5"/>
                                <img src="{{ $team->logo }}" class="h-4 w-4"/>
                                {{ $team->abbreviation }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @admin
                    <li>
                        <div class="text-xs leading-6 text-muted">Admin</div>
                        <ul role="list" class="ml-0.5 mt-2 space-y-1">
                            <li>
                                <x-nav-link :href="route('feeds')" :active="request()->routeIs('feeds')">
                                    <img src="{{ secure_asset('img/nav-icons/feeds.svg') }}" class="h-5 w-5"/>
                                    {{ __('Feeds') }}
                                </x-nav-link>
                            </li>
                        </ul>
                    </li>
                @endadmin
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Static sidebar for desktop -->
    <div class="hidden lg:fixed lg:inset-y-0 lg:z-50 lg:flex lg:w-72 lg:flex-col">
      <div class="flex grow flex-col gap-y-5 overflow-y-auto border-r border-gray-200 bg-white px-6 pb-4">

        <a href="{{ route('home') }}" class="flex h-16 shrink-0 items-center space-x-2">
            <div class="h-6 w-6 md:h-8 md:w-8">
                <img src="{{ asset('img/logo.png') }}" alt="CFBP" />
            </div>
            <div class="flex text-lg md:text-2xl font-light text-indigo-600">CFBP</div>
        </a>

        <nav class="flex flex-1 flex-col">
          <ul role="list" class="flex flex-1 flex-col gap-y-7">
            <li>
                <div class="text-xs leading-6 text-muted">NCAA Football</div>
                <ul role="list" class="ml-0.5 space-y-1">
                    <li>
                        <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            <img src="{{ secure_asset('img/pick.svg') }}" class="h-5 w-5"/>
                            {{ __('Home') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('games')" :active="request()->routeIs('games') || request()->routeIs('game')">
                            <img src="{{ secure_asset('img/nav-icons/scoreboard.svg') }}" class="h-5 w-5"/>
                            {{ __('Scoreboard') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('rankings')" :active="request()->routeIs('rankings')">
                            <img src="{{ secure_asset('img/nav-icons/rankings.svg') }}" class="h-5 w-5"/>
                            {{ __('Rankings') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('teams')" :active="request()->routeIs('teams') || request()->routeIs('team')">
                            <img src="{{ secure_asset('img/nav-icons/teams.svg') }}" class="h-6 w-6"/>
                            {{ __('Teams') }}
                        </x-nav-link>
                    </li>
                    @foreach(auth()->user()->favorites() as $team)
                    <li class="pl-2.5">
                        <a href="{{ route('team', $team->id ) }}" class="flex flex-row cursor-pointer hover:font-semibold items-center text-dark group flex gap-x-3 p-2 text-sm">
                            <x-bi-arrow-return-right class="w-4 h-5"/>
                            <img src="{{ $team->logo }}" class="h-4 w-4"/>
                            {{ $team->abbreviation }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </li>
            @admin
                <li>
                    <div class="text-xs leading-6 text-muted">Admin</div>
                    <ul role="list" class="ml-0.5 mt-2 space-y-1">
                        <li>
                            <x-nav-link :href="route('feeds')" :active="request()->routeIs('feeds')">
                                <img src="{{ secure_asset('img/nav-icons/feeds.svg') }}" class="h-5 w-5"/>
                                {{ __('Feeds') }}
                            </x-nav-link>
                        </li>
                    </ul>
                </li>
            @endadmin
            
          </ul>
        </nav>
      </div>
    </div>
  
    <div class="lg:pl-72">
      <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
        <button @click="mobile = !mobile" type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden">
          <span class="sr-only">Open sidebar</span>
          <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
          </svg>
        </button>
  
        <!-- Separator -->
        <div class="h-6 w-px bg-gray-200 lg:hidden" aria-hidden="true"></div>
  
        <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
          <form class="relative flex flex-1" action="#" method="GET">
            <label for="search-field" class="sr-only">Search</label>
            <svg class="pointer-events-none absolute inset-y-0 left-0 h-full w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
              <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
            </svg>
            <input id="search-field" class="block h-full w-full border-0 py-0 pl-8 pr-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm" placeholder="Search..." type="search" name="search">
          </form>
          @auth
          <div class="flex items-center gap-x-4 lg:gap-x-6">
            <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500">
              <span class="sr-only">View notifications</span>
              <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
              </svg>
            </button>
  
            <!-- Separator -->
            <div class="hidden lg:block lg:h-6 lg:w-px lg:bg-gray-200" aria-hidden="true"></div>
  
            <!-- Profile dropdown -->
            <div class="relative">
              <button @click="profile = !profile" type="button" class="-m-1.5 flex items-center p-1.5" id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">Open user menu</span>
                <x-heroicon-o-user-circle class="w-6 h-6 text-gray-500" />
                <span class="hidden lg:flex lg:items-center">
                  <span class="ml-4 text-sm font-semibold leading-6 text-gray-900" aria-hidden="true">
                    {{ auth()->user()->name }}
                  </span>
                  <svg class="ml-2 h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                  </svg>
                </span>
              </button>
  
              <!-- Profile Dropdown -->
              <div 
                x-show="profile"
                @click.away="profile = !profile"
                x-transition:enter="transition ease-out duration-100"
                x-transition:enter-start="transform opacity-0 scale-95"
                x-transition:enter-end="transform opacity-100 scale-100"
                x-transition:leave="transition ease-in duration-75"
                x-transition:leave-start="transform opacity-100 scale-100"
                x-transition:leave-end="transform opacity-0 scale-95"
                class="absolute right-0 z-10 mt-2.5 w-auto origin-top-right rounded-md bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none" 
                role="menu" 
                aria-orientation="vertical" 
                aria-labelledby="user-menu-button" 
                tabindex="-1">
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
            </div>
          </div>
          @else
            <div class="hidden sm:flex sm:items-center space-x-2">
                <x-button link="{{ route('login') }}" color="blue" size="sm">Log In</x-button>
                <x-button link="{{ route('register') }}" color="blue" size="sm" outline>Create Account</x-button>
            </div>
          @endauth
        </div>
      </div>
  
        @isset ($header)
            <header class="bg-gray-50 shadow sticky top-14 z-30">
                <div class="max-w-7xl mx-auto px-2 sm:px-4 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

      <main class="py-10">
        <div class="px-4 sm:px-6 lg:px-8">
          
            {{ $slot }}

        </div>
      </main>
    </div>
  </div>
  