@extends('layouts.nova')

@section('title')
    Two Factor Authentication
@endsection

@section('content')
<form method="POST" action="{{ route('two-factor.login') }}">
    @csrf

    <div class="mb-6">
        <label class="block mb-2" for="code">Code</label>
        <input
            class="form-control form-input form-input-bordered w-full @error('code') form-input-border-error @enderror"
            id="code"
            inputmode="numeric"
            type="text"
            name="code"
            autofocus
            required
            autocomplete="one-time-code"
        >

        @error('code')
            <p class="help-text mt-2 text-red-500">{{ $message }}</p>
        @enderror
    </div>

    <button
        type="submit"
        size="lg"
        class="w-full flex justify-center shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 w-full flex justify-center cursor-pointer rounded text-sm font-bold focus:outline-none focus:ring ring-primary-200 dark:ring-gray-600 inline-flex items-center justify-center h-9 px-3 w-full flex justify-center shadow relative bg-primary-500 hover:bg-primary-400 text-white dark:text-gray-900 w-full flex justify-center"
    >
        <span>Login</span>
    </button>

</form>
@endsection
