@extends('layouts.nova')

@section('title')

    @if (session('status') == 'two-factor-authentication-confirmed')
        Two factor authentication confirmed and enabled successfully.
    @elseif(session('status') == 'two-factor-authentication-enabled' || session('errors'))
        Finish enabling two factor authentication.
    @else
        You have not enabled two factor authentication.
    @endif

@endsection

@section('content')

    @if (session('status') == 'two-factor-authentication-enabled' || session('errors'))

        <p class="mb-6">
            To finish enabling two factor authentication, scan the following QR code using your phone's <span class="font-bold">Google Authenticator</span> application or enter the setup key and provide the generated OTP code.
        </p>

        <div class="mb-6 flex justify-center">
            {!! request()->user()->twoFactorQrCodeSvg() !!}
        </div>

        <div class="mb-6 flex justify-center">
            Setup Key: <div class="font-bold ml-1">{{ decrypt(request()->user()->two_factor_secret) }}</div>
        </div>

        <svg class="block mx-auto mb-6" xmlns="http://www.w3.org/2000/svg" width="100" height="2"
             viewBox="0 0 100 2">
            <path fill="#D8E3EC" d="M0 0h100v2H0z"></path>
        </svg>

        <form method="POST" action="{{ route('two-factor.confirm') }}">
            @csrf

            <div class="mb-6">
                <label class="block mb-2" for="code">Code</label>
                <input
                    class="form-control form-input form-input-bordered w-full @error('code', 'confirmTwoFactorAuthentication') form-input-border-error @enderror"
                    id="code"
                    type="text"
                    inputmode="numeric"
                    name="code"
                    autofocus
                    required
                    autocomplete="one-time-code"
                >

                @error('code', 'confirmTwoFactorAuthentication')
                    <p class="help-text mt-2 text-red-500">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                size="lg"
                class="w-full flex justify-center shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 w-full flex justify-center cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 w-full flex justify-center shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 w-full flex justify-center"
            >
                <span>Confirm</span>
            </button>

        </form>

    @else

        <div class="card-body">

            <p class="mb-6">
                When two factor authentication is enabled, you will be prompted for a secure, random token during authentication.
                You may retrieve this token from your phone's <span class="font-bold">Google Authenticator</span> application.
            </p>

            <form method="POST" action="{{ route('two-factor.enable') }}">
                @csrf

                <button
                    type="submit"
                    size="lg"
                    class="w-full flex justify-center shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 w-full flex justify-center cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 w-full flex justify-center shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 w-full flex justify-center"
                >
                    <span>Enable Two Factor Authentication</span>
                </button>

            </form>

        </div>

    @endif

@endsection
