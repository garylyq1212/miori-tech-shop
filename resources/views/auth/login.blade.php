@extends('layouts.app')

@section('content')
<section class="flex flex-col items-center my-4">
    <form method="POST" action="{{ route('login') }}"
        class="w-11/12 max-w-lg bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <h1 class="text-2xl text-gray-800 text-center font-bold my-3">{{ __('Login') }}</h1>

        <div class="py-3">
            <label for="email" class="block text-gray-700 font-bold py-2">{{ __('E-Mail Address') }}</label>

            <div class="py-3">
                <input id="email" type="email"
                    class="w-full px-3 py-2 border-2 rounded focus:outline-none focus:border-blue-500 @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

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
                    name="password" required autocomplete="current-password">

                @error('password')
                <span class="text-red-600" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="py-3">
            <input class="px-2 mr-2" type="checkbox" name="remember" id="remember"
                {{ old('remember') ? 'checked' : '' }}>

            <label class="text-gray-800" for="remember">
                {{ __('Remember Me') }}
            </label>

            @if (Route::has('register'))
            <a class="block px-2 pt-4 text-blue-500 font-semibold text-sm md:text-base hover:text-blue-800"
                href="{{ route('register') }}">{{ __('Create an account?') }}</a>
            @endif
        </div>

        <div class="md:flex md:justify-between md:items-center text-center py-3">
            <button type="submit"
                class="w-full md:w-1/2 my-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ __('Login') }}
            </button>

            @if (Route::has('password.request'))
            <a class="px-2 text-blue-500 font-semibold text-sm md:text-base hover:text-blue-800"
                href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
            </a>
            @endif
        </div>
    </form>
</section>
@endsection
