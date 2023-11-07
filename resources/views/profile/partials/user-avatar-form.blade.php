<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('User avatar') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Add or Update user avatar") }}
        </p>
    </header>
    <form method="post" action="{{ route('profile.avatar.update') }}">
        @csrf
        @method('patch')
        <div>
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)" required autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>
        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
