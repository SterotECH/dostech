<x-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Profile Information') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Update your account\'s profile information and email address.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        <div x-data="{ photoName: null, photoPreview: null }" class="flex flex-col items-center justify-center col-span-6">
            <!-- Profile Photo File Input -->
            <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />


            <!-- Current Profile Photo -->
            <div class="mt-2" x-show="! photoPreview">
                <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                    class="object-cover rounded-lg size-24">
            </div>

            <!-- New Profile Photo Preview -->
            <div class="mt-2" x-show="photoPreview" style="display: none;">
                <span class="block bg-center bg-no-repeat bg-cover rounded-lg size-24"
                    x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                </span>
            </div>
            <div class="flex gap-x-px">
                <x-secondary-button class="mt-2 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-secondary-button>
                @endif
            </div>
            <x-input-error for="photo" class="mt-2" />
            <p class="mt-2 text-sm rounded-md px-2 py-px {{ $this->user->role->color() }}">
                {{ __($this->user->role->label()) }}
            </p>
        </div>

        <!-- Name -->
        <div class="col-span-6 sm:col-span-2">
            <x-label for="name" value="{{ __('First Name') }}" />
            <x-input id="name" type="text" class="block w-full mt-1" wire:model="state.first_name" required />
            <x-input-error for="first_name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-label for="name" value="{{ __('Last Name') }}" />
            <x-input id="name" type="text" class="block w-full mt-1" wire:model="state.last_name" required />
            <x-input-error for="last_name" class="mt-2" />
        </div>
        <div class="col-span-6 sm:col-span-2">
            <x-label for="name" value="{{ __('Other Name') }}" />
            <x-input id="name" type="text" class="block w-full mt-1" wire:model="state.other_name" />
            <x-input-error for="other_name" class="mt-2" />
        </div>
        <!-- Phone -->
        <div class="col-span-6 sm:col-span-2">
            <x-label for="name" value="{{ __('Phone') }}" />
            <x-input id="name" type="text" class="block w-full mt-1" wire:model="state.phone" required />
            <x-input-error for="phone" class="mt-2" />
        </div>
        <!-- Username -->
        <div class="col-span-6 sm:col-span-2">
            <x-label for="name" value="{{ __('Username') }}" />
            <x-input id="name" type="text" class="block w-full mt-1" wire:model="state.username" required />
            <x-input-error for="username" class="mt-2" />

        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-2">
            <x-label for="email" value="{{ __('Email') }}" />
            <x-input id="email" type="email" class="block w-full mt-1" wire:model="state.email" required />
            <x-input-error for="email" class="mt-2" />


            <p class="mt-2 text-sm dark:text-white">
                {{ __('Your email address is unverified.') }}

                <button type="button"
                    class="text-sm text-gray-600 underline rounded-md dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                    wire:click.prevent="sendEmailVerification">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </p>

            @if ($this->verificationLinkSent)
                <p class="mt-2 text-sm font-medium text-green-600 dark:text-green-400">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
            @endif
        </div>
        <input type="hidden" wire:model="state.role" />
        <x-input-error for="username" class="mt-2" />
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="me-3" on="saved">
            {{ __('Saved.') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Save') }}
        </x-button>
    </x-slot>
</x-form-section>
