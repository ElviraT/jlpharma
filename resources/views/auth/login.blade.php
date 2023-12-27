@extends('layouts_new.login')


@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="form-horizontal mt-3">

        @csrf
        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="form-control form-control-lg" type="email" name="email" :value="old('email')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="form-control form-control-lg" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-md-12">
                <div class="form-check d-flex align-items-center">
                    <input type="checkbox" class="form-check-input" id="customCheck1" name="remember" />
                    <label class="form-check-label ms-2 mt-1" for="customCheck1">{{ __('Remember Me') }}</label>
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" id="to-recover"
                            class="text-dark ms-auto d-flex align-items-center"><i data-feather="lock"
                                class="feather-sm me-1"></i> {{ __('Forgot Your Password?') }}</a>
                    @endif
                </div>
            </div>
        </div>
        <div class="form-group text-center">
            <div class="col-xs-12 pb-3 mt-3">
                <button class="btn d-block w-100 btn-lg btn-info font-medium" type="submit">
                    {{ __('Log in') }}
                </button>
            </div>
        </div>
        </div>
    </form>
@endsection
