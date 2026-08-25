<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    {{-- ========================================================= --}}
    {{-- Navigation principale                                    --}}
    {{-- ========================================================= --}}

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">

            {{-- Logo + navigation --}}
            <div class="flex">

                {{-- Logo --}}
                <div class="shrink-0 flex items-center">

                    @auth
                        <a href="{{ route('dashboard') }}">
                    @else
                        <a href="{{ url('/') }}">
                    @endauth

                        <a href="{{ url('/') }}" class="flex items-center gap-2">
    
                            <div
                                class="flex h-9 w-9 items-center justify-center
                                    rounded-lg bg-indigo-600
                                    text-white font-bold"
                            >
                                S
                            </div>

                            <span class="text-xl font-bold text-gray-900">
                                Sondage<span class="text-indigo-600">Express</span>
                            </span>

                        </a>

                    </a>

                </div>


                {{-- Navigation desktop --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    {{-- Dashboard uniquement pour les utilisateurs connectés --}}
                    @auth

                        <x-nav-link
                            :href="route('dashboard')"
                            :active="request()->routeIs('dashboard')"
                        >
                            {{ __('Dashboard') }}
                        </x-nav-link>

                    @endauth

                </div>

            </div>


            {{-- ================================================= --}}
            {{-- Zone utilisateur desktop                         --}}
            {{-- ================================================= --}}

            <div class="hidden sm:flex sm:items-center sm:ms-6">

                @auth

                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">

                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                            >

                                <div>
                                    {{ Auth::user()->name }}
                                </div>

                                <div class="ms-1">

                                    <svg
                                        class="fill-current h-4 w-4"
                                        xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd"
                                        />
                                    </svg>

                                </div>

                            </button>

                        </x-slot>


                        <x-slot name="content">

                            {{-- Profil --}}
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profil') }}
                            </x-dropdown-link>


                            {{-- Déconnexion --}}
                            <form
                                method="POST"
                                action="{{ route('logout') }}"
                            >

                                @csrf

                                <x-dropdown-link
                                    :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                >
                                    {{ __('Déconnexion') }}
                                </x-dropdown-link>

                            </form>

                        </x-slot>

                    </x-dropdown>

                @else

                    {{-- Visiteur --}}
                    <div class="flex items-center gap-3">

                        <a
                            href="{{ route('login') }}"
                            class="px-4 py-2 text-sm text-gray-600 hover:text-gray-900"
                        >
                            Se connecter
                        </a>

                        <a
                            href="{{ route('register') }}"
                            class="px-4 py-2 text-sm bg-gray-800 text-white rounded-md hover:bg-gray-700"
                        >
                            Créer un compte
                        </a>

                    </div>

                @endauth

            </div>


            {{-- ================================================= --}}
            {{-- Hamburger mobile                                  --}}
            {{-- ================================================= --}}

            <div class="-me-2 flex items-center sm:hidden">

                <button
                    @click="open = ! open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
                >

                    <svg
                        class="h-6 w-6"
                        stroke="currentColor"
                        fill="none"
                        viewBox="0 0 24 24"
                    >

                        <path
                            :class="{'hidden': open, 'inline-flex': ! open}"
                            class="inline-flex"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />

                        <path
                            :class="{'hidden': ! open, 'inline-flex': open}"
                            class="hidden"
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />

                    </svg>

                </button>

            </div>

        </div>

    </div>


    {{-- ========================================================= --}}
    {{-- Navigation mobile                                        --}}
    {{-- ========================================================= --}}

    <div
        :class="{'block': open, 'hidden': ! open}"
        class="hidden sm:hidden"
    >

        {{-- Dashboard connecté --}}
        @auth

            <div class="pt-2 pb-3 space-y-1">

                <x-responsive-nav-link
                    :href="route('dashboard')"
                    :active="request()->routeIs('dashboard')"
                >
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>

            </div>

        @endauth


        {{-- ===================================================== --}}
        {{-- Options utilisateur mobile                           --}}
        {{-- ===================================================== --}}

        <div class="pt-4 pb-1 border-t border-gray-200">

            @auth

                <div class="px-4">

                    <div class="font-medium text-base text-gray-800">
                        {{ Auth::user()->name }}
                    </div>

                    <div class="font-medium text-sm text-gray-500">
                        {{ Auth::user()->email }}
                    </div>

                </div>

                <div class="mt-3 space-y-1">

                    {{-- Profil --}}
                    <x-responsive-nav-link
                        :href="route('profile.edit')"
                    >
                        {{ __('Profile') }}
                    </x-responsive-nav-link>


                    {{-- Déconnexion --}}
                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >

                        @csrf

                        <x-responsive-nav-link
                            :href="route('logout')"
                            onclick="event.preventDefault(); this.closest('form').submit();"
                        >
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>

                    </form>

                </div>

            @else

                {{-- Visiteur mobile --}}
                <div class="px-4 space-y-2">

                    <a
                        href="{{ route('login') }}"
                        class="block px-4 py-2 text-gray-600 hover:text-gray-900"
                    >
                        Se connecter
                    </a>

                    <a
                        href="{{ route('register') }}"
                        class="block px-4 py-2 bg-gray-800 text-white rounded-md"
                    >
                        Créer un compte
                    </a>

                </div>

            @endauth

        </div>

    </div>

</nav>