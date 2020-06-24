<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- Alpine.js --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

    <style>
        .cart-container {
            align-items: center;
        }

        .StripeElement {
            /* box-sizing: border-box; */

            /* height: 40px; */

            padding: 0.5rem 0.75rem;

            border: 2px solid transparent;
            border-radius: 0.25rem;
            background-color: white;

            box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);

            -webkit-transition: box-shadow 150ms ease;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            /* box-shadow: 0 1px 3px 0 #cfd7df; */
            border: 2px solid #63b3ed;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }

        #card-errors {
            color: #fa755a;
        }
    </style>
</head>

<body class="bg-gray-100">
    <header class="text-gray-700 bg-gray-200 shadow sm:flex sm:justify-between sm:items-center sm:p-6"
        x-data="{ isOpen: false }">
        <div class="container mx-auto p-5 flex items-center justify-between sm:p-0 sm:mx-4">
            <a href="{{ route('welcome') }}"
                class="flex-1 flex font-medium items-center mb-0 text-lg hover:text-gray-900">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" class="w-10 h-10 text-white p-2 bg-indigo-500 rounded-full"
                    viewBox="0 0 24 24">
                    <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                </svg>

                <span class="ml-3 font-bold md:text-xl">
                    {{ config('app.name', 'Laravel') }}
                </span>
            </a>

            <a href="{{ route('cart.index') }}" class="font-bold mx-2 md:text-xl hover:text-gray-900">
                {{-- cart icon --}}
                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                    </path>
                </svg>
            </a>

            <button @click="isOpen = !isOpen" class="w-8 h-8 mx-2 hover:text-gray-900 sm:hidden">
                <template x-if="isOpen">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        {{-- x icon --}}
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </template>

                <template x-if="!isOpen">
                    <svg fill="currentColor" viewBox="0 0 20 20">
                        {{-- hamburger menu icon --}}
                        <path fill-rule="evenodd"
                            d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                            clip-rule="evenodd"></path>
                    </svg>
                </template>
            </button>
        </div>

        <nav x-bind:class="{ 'block': isOpen, 'hidden': !isOpen }" class="text-center sm:flex sm:items-center sm:mx-2"
            @click.away="isOpen = false">
            <a class="p-3 block font-semibold hover:text-gray-900 hover:bg-gray-400 sm:hover:bg-transparent"
                href="{{ route('products.index') }}">Products</a>

            <!-- Authentication Links -->
            @guest
            <a class="p-3 block font-semibold hover:text-gray-900 hover:bg-gray-400 sm:hover:bg-transparent"
                href="{{ route('login') }}">{{ __('Login') }}</a>
            @if (Route::has('register'))
            <a class="p-3 block font-semibold hover:text-gray-900 hover:bg-gray-400 sm:hover:bg-transparent"
                href="{{ route('register') }}">{{ __('Register') }}</a>
            @endif
            @else
            <div x-data="{ open: false }" class="sm:mx-6">
                <a @click="open = true" href="#"
                    class="flex items-center justify-center py-5 sm:py-0 font-semibold hover:text-gray-900 hover:bg-gray-200"
                    aria-haspopup="true" aria-expanded="false" v-pre>
                    {{ Auth::user()->name }}

                    {{-- chevron down icon --}}
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>

                <div x-show.transition="open" @click.away="open = false"
                    class="w-1/2 sm:w-3/12 mx-auto my-2 border border-gray-400 shadow-md rounded bg-white sm:absolute sm:right-0 sm:mx-4"
                    aria-labelledby="navbarDropdown">
                    <a class="p-3 block font-semibold hover:text-gray-900 hover:bg-gray-200" href="{{ route('home') }}">
                        Profile
                    </a>

                    <a class="p-3 block font-semibold hover:text-gray-900 hover:bg-gray-200"
                        href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{ __('Logout') }}
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
            @endguest
        </nav>
    </header>

    <main>
        @yield('content')
    </main>
</body>

</html>
