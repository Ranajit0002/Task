<section class="w-full">
    <header class="mb-6">
        <h2 class="text-base font-semibold text-white">
            {{ __('Profile Information') }}
        </h2>

        <p class="mt-1 text-xs text-zinc-400">
            {{ __("Update your account's profile information and email address.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4 w-full">
        @csrf
        @method('patch')

        <!-- Name Input -->
        <div class="w-full">
            <label for="name" class="block text-xs font-medium text-zinc-300 mb-1">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name"
                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 focus:outline-none focus:border-zinc-500 transition" />
            @if($errors->get('name'))
                <ul class="text-xs text-red-400 mt-1 space-y-1">
                    @foreach((array) $errors->get('name') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif
        </div>

        <!-- Email Input -->
        <div class="w-full">
            <label for="email" class="block text-xs font-medium text-zinc-300 mb-1">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required autocomplete="username"
                class="w-full px-3 py-2 bg-zinc-950 border border-zinc-800 rounded-lg text-sm text-zinc-100 focus:outline-none focus:border-zinc-500 transition" />
            @if($errors->get('email'))
                <ul class="text-xs text-red-400 mt-1 space-y-1">
                    @foreach((array) $errors->get('email') as $message)
                        <li>{{ $message }}</li>
                    @endforeach
                </ul>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3 p-3 bg-zinc-950 border border-zinc-800 rounded-lg">
                    <p class="text-xs text-zinc-300">
                        {{ __('Your email address is unverified.') }}

                        <button form="send-verification" class="underline text-xs text-white hover:text-zinc-300 rounded-md focus:outline-none ml-1">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-xs text-emerald-400">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Submit Button & Saved Notification -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="px-4 py-2 bg-white text-black font-medium text-xs rounded-lg hover:bg-zinc-200 transition">
                {{ __('Save') }}
            </button>

            @if (session('status') === 'profile-updated')
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