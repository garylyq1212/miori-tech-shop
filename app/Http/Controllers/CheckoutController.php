<?php

namespace App\Http\Controllers;

use Darryldecode\Cart\Facades\CartFacade;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $cartItems = CartFacade::session(auth()->id())->getContent();
        $total = CartFacade::session(auth()->id())->getTotal();

        return view('checkout', ['cartItems' => $cartItems, 'total' => $total]);
    }

    public function store()
    {
        $paymentMethod = request()->paymentMethodId;
        // $paymentMethod = 'test123';

        $contents = CartFacade::session(auth()->id())->getContent();
        $billingTotal = CartFacade::session(auth()->id())->getTotal();

        try {
            $payment = Auth::user()->charge(
                // convert decimal to integer, stripe only accept integer
                $billingTotal * 100,
                $paymentMethod,
                ['currency' => env('CASHIER_CURRENCY', 'myr')]
            );
            // dd($payment);

            // TODO: add the product(s) to the order table

            CartFacade::session(auth()->id())->clear();
            return redirect()->route('home')->with('status', 'Order completed!');
        } catch (Exception $e) {
            // dd($e->getMessage());
            return back()->with('error', $e->getMessage());
        }
    }
}
