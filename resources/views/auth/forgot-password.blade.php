@extends('layouts_new.login')


@section('content')
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')"
                required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="form-group text-center">
            <div class="col-xs-12 pb-3 mt-3">
                <button class="btn d-block w-100 btn-lg btn-info font-medium" type="submit">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </div>
    </form>
@endsection
