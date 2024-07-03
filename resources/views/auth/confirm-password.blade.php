<x-guest-layout>
    <x-authentication-card>
        <div class="flex items-center justify-center col-span-2 py-12">
            <div class="mx-auto grid w-[350px] gap-6">
                <div class="grid gap-2 text-center">
                    <h1 class="text-3xl font-bold underline">
                    {{ __('Confirm Password') }}
                    </h1>
                    <p class="text-sm text-gray-600 dark:text-gray-400">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </p>
                </div>

                @session('status')
                    <div class="mb-4 text-sm font-medium text-green-600 dark:text-green-400">
                        {{ $value }}
                    </div>
                @endsession

                <x-validation-errors class="mb-4" />

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <div>
                        <x-label for="password" value="{{ __('Password') }}" />
                        <x-input id="password" class="block w-full mt-1" type="password" name="password" required autocomplete="current-password" autofocus />
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-button class="ms-4">
                            {{ __('Confirm') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
