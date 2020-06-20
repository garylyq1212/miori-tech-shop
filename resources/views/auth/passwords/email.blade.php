@extends('layouts.app')

@section('content')
<section class="flex flex-col items-center my-4">

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}"
        class="w-11/12 max-w-lg bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf

        <h1 class="text-2xl text-gray-800 text-center font-bold my-3">{{ __('Reset Password') }}</h1>

        <div class="py-3">
            <label for="email" class="block text-gray-700 font-bold py-2">{{ __('E-Mail Address') }}</label>

            <div class="col-md-6">
                <input id="email" type="email"
                    class="w-full px-3 py-2 border-2 rounded focus:outline-none focus:border-blue-500 @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>

        <div class="py-3">
            <button type="submit"
                class="w-full my-3 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ __('Send Password Reset Link') }}
            </button>
        </div>
    </form>
</section>
@endsection
