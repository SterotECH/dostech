<x-guest-layout>
    <x-authentication-card >
        <div class="flex items-center justify-center py-12">
            <div class="mx-auto grid w-[350px] gap-6">
                <div class="grid gap-2 text-center">
                    <h1 class="text-3xl font-bold underline">
                        Login
                    </h1>
                    <p class="text-balance text-muted-foreground">
                        {{ __('Enter your username and password below to login to your account') }}
                    </p>
                </div>
                @session('status')
                    <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                        {{ $value }}
                    </div>
                @endsession

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="grid gap-4">
                        <div class="grid gap-2">
                            <x-label for="username" value="{{ __('Username') }}" />
                            <x-input
                                id="username"
                                class="block w-full mt-1"
                                name="username"
                                :value="old('username')"
                                required
                                autofocus
                            />
                        </div>
                        <div class="grid gap-2">
                            <div class="flex items-center">
                                <x-label for="password" value="{{ __('Password') }}" />
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="inline-block ml-auto text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                                        wire:navigate>
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                            <x-input
                                id="password"
                                class="block w-full mt-1"
                                type="password"
                                name="password"
                                required
                                autocomplete="current-password"
                            />
                        </div>
                        <div class="block w-full">
                            <label for="remember_me" class="flex items-center">
                                <x-checkbox id="remember_me" name="remember" />
                                <span
                                    class="text-sm text-gray-600 ms-2 dark:text-gray-400">{{ __('Remember me') }}</span>
                            </label>
                        </div>
                        <x-button type="submit" class="w-full" wire:loading.attr="disabled">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
        <div class="hidden bg-muted lg:block">
            <img src="{{ Vite::asset('resources/images/background.jpg') }}" alt="login background" width="1920"
                height="1080" class="h-full w-full object-cover dark:brightness-[0.8] dark:grayscale">
        </div>
    </x->
</x-guest-layout>
