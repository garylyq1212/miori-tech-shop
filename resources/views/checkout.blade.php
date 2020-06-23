@extends('layouts.app')

@section('content')
<section class="mx-4 overflow-x-hidden">
    <div class="mx-4 sm:mx-0 lg:grid lg:grid-cols-5 lg:gap-3">
        <div class="my-5 lg:col-start-1 lg:col-end-4 px-6 py-4 bg-white shadow-md rounded">
            <h1 class="font-bold text-2xl tracking-wider mb-5">Payment Details</h1>

            <div class="my-3">
                <label for="card-holder-name">Your Name</label>
                <input id="card-holder-name" type="text"
                    class="my-3 w-full px-3 py-2 shadow rounded border-2 border-white focus:outline-none focus:border-blue-400"
                    placeholder="Your name">
            </div>

            <div class="my-3">
                <label for="card-element">Credit or Debit Card</label>
                <!-- Stripe Elements Placeholder -->
                <div id="card-element" class="my-3"></div>
            </div>

            <button id="card-button"
                class="my-6 px-3 py-2 bg-blue-500 text-lg font-bold rounded shadow text-white w-full hover:bg-blue-700 md:transition md:duration-200 md:ease-in-out">
                Process Payment
            </button>
        </div>

        <div class="my-5 lg:col-start-4 lg:col-end-6 px-4 py-4 bg-white shadow-md rounded">
            <h2 class="font-bold text-xl tracking-wide mb-5">Order Summary</h2>

            @forelse ($cartItems as $item)
            <div class="flex justify-between items-center font-semibold mb-5">
                <div class="py-5 w-1/4 sm:w-auto">
                    <img src="/storage/{{ $item->model->image }}" alt="{{ $item->model->slug }}" class="w-16 h-auto">
                </div>

                <div class="w-3/5 text-sm sm:w-3/4 sm:flex sm:justify-around sm:items-center sm:text-base">
                    <p class="mx-1 my-2 text-gray-700">{{ $item->name }}</p>
                    <p class="mx-3 my-2">{{ $item->quantity }}x</p>
                    <p class="mx-1 my-2 text-gray-700">RM{{ $item->price }}</p>
                </div>
            </div>
            @empty
            <h1 class="my-5 text-xl">You have no item in the cart</h1>
            @endforelse
            <p class="flex justify-between font-bold text-lg">
                Total: <span>RM{{ $total }}</span>
            </p>
        </div>
    </div>
</section>

{{-- Stripe.js --}}
<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe('{{ env('STRIPE_KEY', '') }}');

    const elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    const style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    };

    const cardElement = elements.create('card', {style});

    cardElement.mount('#card-element');
</script>
@endsection
