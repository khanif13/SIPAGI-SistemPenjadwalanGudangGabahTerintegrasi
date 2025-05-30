{{-- <section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password"
                class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password" :value="__('New Password')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full"
                autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password"
                class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600">{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section> --}}
<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')
    <div class="row mb-3">
        <label for="update_password_current_password" class="col-md-4 col-lg-3 col-form-label">Current
            Password</label>
        <div class="col-md-8 col-lg-9">
            <input name="current_password" type="password" class="form-control" id="update_password_current_password">
        </div>
    </div>

    <div class="row mb-3">
        <label for="update_password_password" class="col-md-4 col-lg-3 col-form-label">New Password</label>
        <div class="col-md-8 col-lg-9">
            <input name="password" type="password" class="form-control" id="update_password_password">
        </div>
    </div>

    <div class="row mb-3">
        <label for="update_password_password_confirmation" class="col-md-4 col-lg-3 col-form-label">Re-enter New
            Password</label>
        <div class="col-md-8 col-lg-9">
            <input name="password_confirmation" type="password" class="form-control"
                id="update_password_password_confirmation">
        </div>
    </div>

    <div class="text-center">
        <button type="submit" class="btn btn-primary">Change Password</button>
    </div>
</form><!-- End Change Password Form -->
@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
