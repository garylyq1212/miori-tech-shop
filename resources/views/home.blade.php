@extends('layouts.app')

@section('content')
<section class="py-4 container mx-auto">
    @if (session()->has('status'))
    <div class="w-1/2 border border-green-600 p-2 rounded">
        <p class="text-green-600 font-semibold text-center">{{ session()->get('status') }}</p>
    </div>
    @endif

    <div>
        <h1>Your Orders</h1>
        {{-- @if ()

        @endif --}}
        @forelse ($orders as $order)
        <div>
            <p>{{ $order->product->name }}</p>
            <p>{{ $order->quantity }}x</p>
            <img src="/storage/{{ $order->product->image }}" alt="{{ $order->product->slug }}" class="w-40">
            <p>{{ $order->created_at->localeDayOfWeek }}</p>
            <p>{{ $order->created_at->diffForHumans() }}</p>
        </div>
        @empty
        <p>Nothing</p>
        @endforelse
    </div>
</section>
@endsection
