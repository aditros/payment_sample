<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Customer Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Update your customer's profile information.") }}
        </p>
    </header>

    <form method="post" :action="request()->routeIs('customer.create.index') ? route('customer.create.post') : route('customer.edit.patch')" class="mt-6 space-y-6">
        @csrf
        @if (request()->routeIs('customer.edit.index'))
          @method('patch')
        @endif

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="request()->routeIs('customer.edit.index') ? $customer->name : ''" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="request()->routeIs('customer.edit.index') ? $customer->email : ''" required />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>
        
        <div>
            <x-input-label for="cc_number" :value="__('CC Number')" />
            <x-text-input id="cc_number" name="cc_number" type="text" class="mt-1 block w-full" :value="request()->routeIs('customer.edit.index') ? $customer->cc_number : ''" />
            <x-input-error class="mt-2" :messages="$errors->get('cc_number')" />
        </div>
        
        <div>
            <x-input-label for="acc_number" :value="__('ACC Number')" />
            <x-text-input id="acc_number" name="acc_number" type="text" class="mt-1 block w-full" :value="request()->routeIs('customer.edit.index') ? $customer->acc_number : ''" />
            <x-input-error class="mt-2" :messages="$errors->get('acc_number')" />
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
