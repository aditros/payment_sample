<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('API Token') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Click regenerate to refresh new token.") }}
        </p>
    </header>

    <form method="post" action="{{ route('profile.api-token') }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="api_token" :value="__('API Token')" />
            <x-text-input id="api_token" name="api_token" type="text" class="mt-1 block w-full" :value="old('name', $user->api_token)" />
            <x-input-error class="mt-2" :messages="$errors->get('api_token')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Regenerate') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
