<x-app-layout>
    <div class="w-full space-y-8">
        <!-- Top Section Header -->
        <div class="border-b border-zinc-800 pb-6 w-full">
            <h1 class="text-2xl font-bold text-white tracking-tight">Account Settings</h1>
            <p class="text-xs text-zinc-400 mt-1">Manage your account credentials, security preferences, and personal details.</p>
        </div>

        <div class="space-y-6 w-full">
            <!-- Update Profile Information Card -->
            <div class="p-6 sm:p-8 bg-zinc-900 border border-zinc-800 rounded-xl shadow-xl w-full">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="p-6 sm:p-8 bg-zinc-900 border border-zinc-800 rounded-xl shadow-xl w-full">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="p-6 sm:p-8 bg-zinc-900 border border-zinc-800 rounded-xl shadow-xl w-full">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>