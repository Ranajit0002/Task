<section class="w-full">
    <header class="mb-6">
        <h2 class="text-base font-semibold text-white">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-xs text-zinc-400">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4 w-full">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div class="w-full">
            <label for="update_password_current_password" class="block text-xs font-medium text-zinc-300 mb-1">{{ __('Current Password') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" autocomplete="current-password"
                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 focus:outline-none focus:border-zinc-500 transition" />
            @if($errors->updatePassword->get('current_password'))
                <ul class="text-xs text-red-400 mt-1 space-y-1">
                    @foreach((array) $errors->updatePassword->get('current_password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- New Password -->
        <div class="w-full">
            <label for="update_password_password" class="block text-xs font-medium text-zinc-300 mb-1">{{ __('New Password') }}</label>
            <input id="update_password_password" name="password" type="password" autocomplete="new-password"
                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 focus:outline-none focus:border-zinc-500 transition" />
            @if($errors->updatePassword->get('password'))
                <ul class="text-xs text-red-400 mt-1 space-y-1">
                    @foreach((array) $errors->updatePassword->get('password') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Confirm Password -->
        <div class="w-full">
            <label for="update_password_password_confirmation" class="block text-xs font-medium text-zinc-300 mb-1">{{ __('Confirm Password') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" autocomplete="new-password"
                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 focus:outline-none focus:border-zinc-500 transition" />
            @if($errors->updatePassword->get('password_confirmation'))
                <ul class="text-xs text-red-400 mt-1 space-y-1">
                    @foreach((array) $errors->updatePassword->get('password_confirmation') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Submit Button & Saved Notification -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-4 py-2 bg-white text-black font-medium text-xs rounded-lg hover:bg-zinc-200 transition">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-xs font-medium text-emerald-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>