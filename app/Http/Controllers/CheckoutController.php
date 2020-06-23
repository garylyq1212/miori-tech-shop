<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartFacade::session(auth()->id())->getContent();
        $total = CartFacade::session(auth()->id())->getTotal();

        return view('checkout', ['cartItems' => $cartItems, 'total' => $total]);
    }
}
