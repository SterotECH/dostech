<x-guest-layout>
    <x-authentication-card>
        <div class="flex items-center justify-center col-span-2 py-12">
            <div class="mx-auto grid w-[350px] gap-6">
                <div x-data="{ recovery: false }">
                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-show="! recovery">
                        {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
                    </div>

                    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400" x-cloak x-show="recovery">
                        {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
                    </div>

                    <x-validation-errors class="mb-4" />

                    <form method="POST" action="{{ route('two-factor.login') }}">
                        @csrf

                        <div class="mt-4" x-show="! recovery">
                            <x-label for="code" value="{{ __('Code') }}" />
                            <x-input id="code" class="block w-full mt-1" type="text" inputmode="numeric"
                                name="code" autofocus x-ref="code" />
                        </div>

                        <div class="mt-4" x-cloak x-show="recovery">
                            <x-label for="recovery_code" value="{{ __('Recovery Code') }}" />
                            <x-input id="recovery_code" class="block w-full mt-1" type="text" name="recovery_code"
                                x-ref="recovery_code" />
                        </div>

                        <div class="flex-col items-center justify-center mt-4 text-center">
                            <x-button type="button"
                                variant="link"
                                x-show="! recovery"
                                x-on:click="
                                        recovery = true;
                                        $nextTick(() => { $refs.recovery_code.focus() })
                                    ">
                                {{ __('Use a recovery code') }}
                            </x-button>

                            <x-button type="button"
                                variant="link"
                                x-cloak x-show="recovery"
                                x-on:click="
                                        recovery = false;
                                        $nextTick(() => { $refs.code.focus() })
                                    ">
                                {{ __('Use an authentication code') }}
                            </x-button>

                            <x-button class="w-full ms-4">
                                {{ __('Log in') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-authentication-card>
</x-guest-layout>
