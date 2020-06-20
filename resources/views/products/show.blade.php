@extends('layouts.app')

@section('content')
<section class="mx-4 md:w-10/12 md:mx-auto">
    <ul class="flex bg-gray-200 p-2">
        <li class="mx-2 text-blue-600 hover:text-blue-900 text-sm md:text-base">
            <a class="active:text-blue-900" href="{{ route('welcome') }}">Home</a>
        </li>

        <span>/</span>

        <li class="mx-2 text-blue-600 hover:text-blue-900 text-sm md:text-base">
            <a class="active:text-blue-900" href="{{ route('products.index') }}">All Products</a>
        </li>

        <span>/</span>

        <li class="mx-2 text-blue-600 hover:text-blue-900 text-sm md:text-base">
            <a class="active:text-blue-900"
                href="{{ route('products.show', ['product' => $product->slug]) }}">{{ $product->name }}</a>
        </li>
    </ul>

    <div class="flex flex-col md:items-center md:flex-row md:justify-center my-5">
        <div class="md:w-1/2">
            <img class="w-7/12" src="/storage/{{ $product->image }}" alt="{{ $product->slug }}">
        </div>
        <div class="md:w-1/2">
            <h1 class="font-bold text-xl md:text-lg my-5">{{ $product->name }}</h1>

            <div class="bg-gray-200 p-1 rounded">
                <p class="font-semibold text-2xl my-3 text-indigo-700">RM{{ $product->price }}</p>
            </div>

            <div class="my-10">
                <form action="{{ route('cart.store', $product) }}" method="POST">
                    @csrf

                    <div class="flex items-center">
                        <label class="text-gray-700" for="quantity">Quantity:</label>

                        <input class="text-center mx-8 border border-gray-500" type="number" id="quantity"
                            name="quantity" id="quantity" value="1">
                    </div>

                    <button type="submit"
                        class="flex items-center justify-center mt-8 py-3 w-full bg-indigo-500 rounded shadow-md font-bold text-white transition ease-in duration-200 hover:bg-blue-800 active:bg-blue-800">
                        <span class="mr-3">
                            {{-- cart icon --}}
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3zM16 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM6.5 18a1.5 1.5 0 100-3 1.5 1.5 0 000 3z">
                                </path>
                            </svg>
                        </span>
                        Add to Cart
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="my-5">
        <div class="bg-gray-200 px-2 rounded">
            <h1 class="font-semibold sm:text-xl py-3 text-gray-700">Product Description</h1>
        </div>

        <div class="my-4 text-sm md:test-base text-gray-800">
            {!! $product->description !!}
        </div>
    </div>
</section>
@endsection
