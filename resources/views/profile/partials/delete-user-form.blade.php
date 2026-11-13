<section class="w-full space-y-6">
    <header class="mb-6">
        <h2 class="text-base font-semibold text-white">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-xs text-zinc-400">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>

    <button
        type="button"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-4 py-2 bg-red-600/10 border border-red-900/50 hover:bg-red-600/20 text-red-400 font-medium text-xs rounded-lg transition"
    >
        {{ __('Delete Account') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-zinc-900 border border-zinc-800 rounded-xl space-y-4">
            @csrf
            @method('delete')

            <div>
                <h2 class="text-base font-semibold text-white">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-xs text-zinc-400">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>
            </div>

            <div class="w-full pt-2">
                <label for="password" class="sr-only">{{ __('Password') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    placeholder="{{ __('Password') }}"
                    class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 placeholder-zinc-500 focus:outline-none focus:border-red-500 transition"
                />

                @if($errors->userDeletion->get('password'))
                    <ul class="text-xs text-red-400 mt-1 space-y-1">
                        @foreach((array) $errors->userDeletion->get('password') as $message)
                            <li>{{ $message }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>

            <div class="pt-4 flex justify-end gap-3 border-t border-zinc-800">
                <button
                    type="button"
                    x-on:click="$dispatch('close')"
                    class="px-4 py-2 bg-zinc-800 hover:bg-zinc-700 text-zinc-200 text-xs font-medium rounded-lg transition"
                >
                    {{ __('Cancel') }}
                </button>

                <button
                    type="submit"
                    class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-xs font-medium rounded-lg transition"
                >
                    {{ __('Delete Account') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>