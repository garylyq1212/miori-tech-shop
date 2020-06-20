@extends('layouts.app')

@section('content')
<h1>Cart</h1>
@forelse ($cartItems as $item)
<h1>{{$item->name}}</h1>
<p>{{$item->price}}</p>
<p>{{$item->quantity}}</p>
@empty
<h1>Empty Cart.</h1>
@endforelse
<h3>{{$total}}</h3>
@endsection
