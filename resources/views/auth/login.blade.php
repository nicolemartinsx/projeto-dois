<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div x-data="{ activeTab: 0 }">
        <div class="flex p-4 justify-between">
            <button
                @click="activeTab = 0"
                :class="{ 'border-b border-b-blue-600': activeTab === 0 }">Servidor</button>
            <button
                @click="activeTab = 1"
                :class="{ 'border-b border-b-blue-600': activeTab === 1 }">Professor</button>
        </div>

        <div x-show="activeTab === 0">
            <form method="POST" action="{{ route('login') }}" class="mt-4">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Senha')" />

                    <x-text-input id="password" class="block mt-1 w-full"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Lembrar-me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Esqueci minha senha') }}
                    </a>
                    @endif

                    <x-primary-button class="ms-3">
                        {{ __('Log in') }}
                    </x-primary-button>
                </div>
            </form>
        </div>
        <div x-show="activeTab === 1">
            <div class="flex justify-center mt-4">
                <a href="{{ url('login/google') }}">
                    <x-primary-button>
                        <span class="mr-2">
                            <img src="https://accounts.scdn.co/sso/images/new-google-icon.72fd940a229bc94cf9484a3320b3dccb.svg" class="w-5 h-5" alt="Google logo">
                        </span>
                        {{ __('Continuar com o Google') }}
                    </x-primary-button>
                </a>
            </div>
        </div>
    </div>
</x-guest-layout>