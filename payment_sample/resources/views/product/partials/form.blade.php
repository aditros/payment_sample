<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Product Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your account's product information and email address.") }}
        </p>
    </header>

    <form method="post" :action="request()->routeIs('product.create.index') ? route('product.create.post') : route('product.edit.patch')" class="mt-6 space-y-6">
        @csrf
        @if (request()->routeIs('product.edit.index'))
          @method('patch')
        @endif

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="request()->routeIs('product.edit.index') ? $product->name : ''" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="price" :value="__('Price')" />
            <x-text-input id="price" name="price" type="number" step="0.01" class="mt-1 block w-full" :value="request()->routeIs('product.edit.index') ? $product->price : ''" required />
            <x-input-error class="mt-2" :messages="$errors->get('price')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

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
