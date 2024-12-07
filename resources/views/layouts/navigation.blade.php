<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex space-x-8">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                </div>

                <x-nav-link :href="route('pdfs.tabela')" :active="request()->routeIs('pdfs.tabela')">
                    {{ __('PEIs') }}
                </x-nav-link>

                @if (Auth::user()->google_id == null)
                <x-nav-link :href="route('pdfs.index')" :active="request()->routeIs('pdfs.index')">
                    {{ __('Adicionar PEI') }}
                </x-nav-link>
                <x-nav-link :href="route('professors')" :active="request()->routeIs('professors')">
                    {{ __('Professores') }}
                </x-nav-link>
                @endif

                <!-- Header para o admin -->
                @if (Auth::user()->role == 'admin')
                <x-nav-link :href="route('users')" :active="request()->routeIs('users')">
                    {{ __('Servidores') }}
                </x-nav-link>
                @endif
            </div>

            <!-- Settings Dropdown -->
            <div class="flex items-center ms-6">
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
                        @if (!Auth::user()->google_id)
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Perfil') }}
                        </x-dropdown-link>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Sair') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>