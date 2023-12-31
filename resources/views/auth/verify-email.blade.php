@extends('layouts_new.login')


@section('content')
    <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
            {{ __('A new verification link has been sent to the email address you provided during registration.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <div class="form-group text-center">
                <div class="col-xs-12 pb-3 mt-3">
                    <button class="btn d-block w-100 btn-lg btn-info font-medium" type="submit">
                        {{ __('Resend Verification Email') }}
                    </button>
                </div>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <div class="form-group text-center">
                <div class="col-xs-12 pb-3 mt-3">
                    <button class="btn d-block w-100 btn-lg btn-info font-medium" type="submit">
                        {{ __('Log Out') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
