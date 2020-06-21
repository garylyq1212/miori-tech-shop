@extends('layouts.app')

@section('content')
<section class="container mx-auto">
    <div class="mx-4">
        @if (session()->has('status'))
        <div class="w-1/4 mx-auto border border-green-600 p-2 rounded">
            <p class="text-green-600 font-semibold text-center">{{ session()->get('status') }}</p>
        </div>
        @endif

        <h1 class="text-2xl font-bold">Cart</h1>

        @forelse ($products as $product)
        <h1>{{$product->name}}</h1>
        <p>{{$product->price}}</p>
        <p>{{$product->quantity}}</p>

        <form action="{{ route('cart.destroy', $product->id) }}" method="POST">
            @csrf

            @method('DELETE')

            <button type="submit" class="text-red-600">Remove</button>
        </form>
        @empty
        <h1>Empty Cart</h1>
        <a href="{{ route('products.index') }}">Keep Shopping</a>
        @endforelse

        <h3>Total: RM{{$total}}</h3>
    </div>
</section>
@endsection
