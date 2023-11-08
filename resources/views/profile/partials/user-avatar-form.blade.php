<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('User avatar') }}
        </h2>

        @if ($user->avatar)
            <img width="100" src="storage/{{$user->avatar}}" alt="user avatar">
        @endif

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Add or Update user avatar") }}
        </p>
    </header>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <form method="post" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data">
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
