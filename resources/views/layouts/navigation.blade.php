<nav x-data="{ open: false }" class="bg-#242424 border-b">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Left Section (Logo) -->
            <div class="flex items-center">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    @if (Auth::user()->usertype === 'admin')
                        <a href="{{route('admin.dashboard')}}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    @else
                        <a href="{{route('welcome')}}">
                            <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                        </a>
                    @endif
                </div>
            </div>

            <!-- Right Section (Nav Links and Settings Dropdown) -->
            <div class="flex items-center space-x-8 sm:ms-auto">
                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:flex">
                    <!-- Dashboard -->
                    <x-nav-link :href="Auth::user()->usertype == 'admin' ? route('admin.dashboard') : route('dashboard')"
                                :active="Auth::user()->usertype == 'admin' ? request()->routeIs('admin.dashboard') : request()->routeIs('dashboard')">
                        {{ __('Home') }}
                    </x-nav-link>

                    <!-- Admin Links -->
                    @if (Auth::user()->usertype == 'admin')
                        <x-nav-link href="{{ route('admin.product')}}" :active="request()->routeIs('admin.product')">
                            {{ __('Product') }}
                        </x-nav-link>
                        <x-nav-link href="{{ route('admin.test')}}" :active="request()->routeIs('admin.test')">
                            {{ __('POS') }}
                        </x-nav-link>
                        {{-- <x-nav-link href="{{ route('admin.orders')}}" :active="request()->routeIs('admin.orders')">
                            {{ __('Orders') }}
                        </x-nav-link> --}}

                    @endif

                    <!-- User Links -->
                    @if (Auth::user()->usertype == 'user')
                        <x-nav-link href="{{ url('cart') }}" :active="request()->routeIs('cart')">
                            {{ __('Cart') }}
                        </x-nav-link>
                        <x-nav-link href="{{ url('menu') }}" :active="request()->routeIs('menu')">
                            {{ __('Menu') }}
                        </x-nav-link>
                        <x-nav-link href="{{ url('userProfile') }}" :active="request()->routeIs('userProfile')">
                            {{ __('Profile') }}
                        </x-nav-link>

                    @endif
                </div>

                <!-- Settings Dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ms-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Edit Profile') }}
                            </x-dropdown-link>

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
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <!-- Responsive Links (e.g., Dashboard) -->
    </div>
</nav>
