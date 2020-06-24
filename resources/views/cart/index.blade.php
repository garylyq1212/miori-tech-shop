@extends('layouts.app')

@section('content')
<section class="py-4 container mx-auto overflow-x-hidden">
    <div class="mx-6 sm:mx-3">
        @if (session()->has('status'))
        <div class="w-1/3 border border-green-600 p-2 rounded">
            <p class="text-green-600 font-semibold text-center">{{ session()->get('status') }}</p>
        </div>
        @endif

        <h1 class="text-2xl font-bold my-5">Your Cart</h1>

        <div class="cart-container grid gap-3 grid-cols-4">
            @forelse ($products as $product)
            <div class="col-start-1 col-end-3 my-6">
                <div class="sm:flex sm:items-center">
                    <a href="{{ route('products.show', $product->model->slug) }}">
                        <img src="/storage/{{ $product->model->image }}" alt="{{ $product->model->slug }}"
                            class="w-32 h-auto">
                    </a>

                    <div class="mx-4 w-1/2">
                        <a href="{{ route('products.show', $product->model->slug) }}"
                            class="text-indigo-500 hover:text-indigo-800">
                            <h3 class="my-4 sm:my-0 text-sm sm:text-base">{{ $product->name }}</h3>
                        </a>
                    </div>
                </div>
            </div>

            <div class="flex w-1/2 sm:h-6">
                <button id="decrement"
                    class="px-1 border border-indigo-500 rounded text-indigo-500 hover:text-indigo-800 hover:border-indigo-800">
                    <!-- minus icon -->
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-minus">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>

                <input class="text-center w-full mx-auto" type="text" name="quantity" id="quantity"
                    value="{{ $product->quantity }}">

                <button id="increment"
                    class="px-1 border border-indigo-500 rounded text-indigo-500 hover:text-indigo-800 hover:border-indigo-800">
                    <!-- plus icon -->
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="feather feather-plus">
                        <line x1="12" y1="5" x2="12" y2="19"></line>
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                </button>
            </div>

            <div>
                <p class="font-semibold text-sm text-right sm:text-lg">RM{{ $product->price }}</p>

                <form action="{{ route('cart.destroy', $product->id) }}" method="POST" class="text-right">
                    @csrf

                    @method('DELETE')

                    <button type="submit" class="text-red-600 text-xs hover:text-red-800">Remove</button>
                </form>
            </div>
            @empty
            <h1>Empty Cart</h1>
            @endforelse
        </div>

        <div class="my-4">
            <div class="bg-gray-200 p-1 rounded-md my-3">
                <h3 class="my-5 font-bold text-lg flex justify-between">
                    Total:
                    <span>RM{{ $total }}</span>
                </h3>
            </div>

            <div class="w-full sm:flex sm:justify-between text-center">
                <a href="{{ route('checkout.index') }}"
                    class="w-full sm:w-1/4 my-2 px-3 py-2 font-semibold text-indigo-500 border-2 border-indigo-500 rounded shadow hover:bg-indigo-600 hover:text-white md:transition md:duration-200 md:ease-out">Checkout</a>

                <a href="{{ route('products.index') }}"
                    class="w-full sm:w-1/4 my-2 px-3 py-2 bg-indigo-500 rounded shadow text-white hover:bg-indigo-800 md:transition md:duration-200 md:ease-out">Continue
                    Shopping</a>
            </div>
        </div>
    </div>
</section>

<script>
    (function() {
        const decrement = document.getElementById("decrement");
        const increment = document.getElementById("increment");
        const quantity = document.getElementById("quantity");

        increment.addEventListener("click", () => {
            quantity.value = Number(quantity.value) + 1;
        });

        decrement.addEventListener("click", () => {
            if (Number(quantity.value) !== 0) {
                quantity.value = Number(quantity.value) - 1;
            }
        });
    });
</script>
@endsection
