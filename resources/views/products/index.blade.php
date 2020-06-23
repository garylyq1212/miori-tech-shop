@extends('layouts.app')

@section('content')
<section class="py-4 container mx-auto">
    <header class="mx-3">
        <ul class="flex bg-gray-200 p-2">
            <li class="mx-2 text-blue-600 hover:text-blue-900">
                <a class="focus:text-blue-900" href="{{ route('welcome') }}">Home</a>
            </li>

            <span>/</span>

            <li class="mx-2 text-blue-600 hover:text-blue-900">
                <a class="focus:text-blue-900" href="{{ route('products.index') }}">All Products</a>
            </li>
        </ul>

        <h1 class="text-3xl font-semibold my-5">All Products</h1>
    </header>

    <div class="md:flex">
        <div class="md:w-1/5 mx-3 border-2 border-gray-400 p-2 rounded">
            <h1 class="text-xl font-semibold mx-2 mb-3">Categories</h1>

            <div class="md:flex md:flex-col md:items-start">
                <a class="mx-2 my-2 text-indigo-600 hover:text-indigo-800" href="{{ route('products.index') }}">All
                    Products</a>
                @forelse ($categories as $category)
                <form action="{{ route('products.index') }}" method="GET">
                    <input type="submit" id="category" name="category" value="{{ $category->name }}"
                        class="mx-2 my-2 text-indigo-600 cursor-pointer bg-white hover:text-indigo-800">
                    {{-- <a href="" class="mx-2 my-2 text-indigo-600">{{ $category->name }}</a> --}}
                </form>
                @empty
                <h2 class="col-start-2 col-end-4 text-center font-bold my-8 text-2xl">No Categories...</h2>
                @endforelse
            </div>
        </div>

        <div class="md:w-3/4 mx-3 grid gap-6 md:grid-cols-3 lg:grid-cols-4">
            @forelse ($products as $product)
            <div class="w-full my-4 flex">
                <a class="bg-white shadow-md p-8 rounded overflow-hidden text-center flex-1 transition ease-in duration-300 md:transform hover:bg-gray-300 hover:scale-105 focus:bg-gray-300 focus:scale-105"
                    href="{{ route('products.show', ['product' => $product->slug]) }}">
                    <img class="w-1/2 mx-auto md:w-3/4" src="/storage/{{ $product->image }}" alt="{{ $product->name }}">

                    <h1 class="font-bold text-xl my-5">{{ $product->name }}</h1>
                    <p class="text-lg font-semibold text-indigo-700">RM{{ $product->price }}</p>
                </a>
            </div>
            @empty
            <h1 class="col-start-2 col-end-4 text-center font-bold my-8 text-2xl">No products found...</h1>
            @endforelse
        </div>
    </div>
</section>
@endsection
