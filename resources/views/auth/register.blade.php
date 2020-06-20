@extends('layouts.app')

@section('content')
<section class="flex flex-col items-center my-4">
    <form method="POST" action="{{ route('register') }}"
        class="w-11/12 max-w-lg bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <h1 class="text-2xl text-gray-800 text-center font-bold my-3">{{ __('Register') }}</h1>

        <div class="py-3">
            <label for="name" class="block text-gray-700 font-bold py-2">{{ __('Name') }}</label>

            <div class="col-md-6">
                <input id="name" type="text"
                    class="w-full px-3 py-2 border-2 rounded focus:outline-none focus:border-blue-500 @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                @error('name')
                <span class="text-red-600" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="py-3">
            <label for="email" class="block text-gray-700 font-bold py-2">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email"
                    class="w-full px-3 py-2 border-2 rounded focus:outline-none focus:border-blue-500 @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email">

                @error('email')
                <span class="text-red-600" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="py-3">
            <label for="password" class="block text-gray-700 font-bold py-2">{{ __('Password') }}</label>

            <div class="col-md-6">
                <input id="password" type="password"
                    class="w-full px-3 py-2 border-2 rounded focus:outline-none focus:border-blue-500 @error('password') is-invalid @enderror"
                    name="password" required autocomplete="new-password">

                @error('password')
                <span class="text-red-600" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="py-3">
            <label for="password-confirm"
                class="block text-gray-700 font-bold py-2">{{ __('Confirm Password') }}</label>

            <div class="col-md-6">
                <input id="password-confirm" type="password"
                    class="w-full px-3 py-2 border-2 rounded focus:outline-none focus:border-blue-500"
                    name="password_confirmation" required autocomplete="new-password">
            </div>
        </div>

        <div class="py-3">
            <a class="block px-2 pb-4 text-blue-500 font-semibold text-sm md:text-base hover:text-blue-800"
                href="{{ route('login') }}">{{ __('Already have an account?') }}</a>

            <button type="submit"
                class="w-full my-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ __('Register') }}
            </button>
        </div>
    </form>
</section>
@endsection
