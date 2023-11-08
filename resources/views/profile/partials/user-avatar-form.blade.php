<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('User avatar') }}
        </h2>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if ($user->avatar)
            <img width="100" src="storage/{{$user->avatar}}" alt="user avatar">
        @endif
        <form action="{{route('profile.avatar.ai')}}" method="post" class="mt-6 space-y-6">
            @csrf
            <p class="mt-1 text-lg text-gray-600">
                {{ __("Generate avatar from AI") }}
            </p>
            <x-primary-button>{{ __('Generate avatar') }}</x-primary-button>
        </form>

    </header>
    <p class="mt-2 text-lg text-gray-600">
        {{ __("or") }}
    </p>
    <form method="post" action="{{ route('profile.avatar.update') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf
        @method('patch')
        <div>
            <p class="text-sm text-gray-600">
                {{ __("Add or Update user avatar") }}
            </p>
            <x-text-input id="avatar" name="avatar" type="file" class="mt-1 block w-full" :value="old('avatar', $user->avatar)" required autofocus autocomplete="avatar" />
            <x-input-error class="mt-2" :messages="$errors->get('avatar')" />
        </div>
        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
