<?php

namespace App\Http\Controllers;

use App\Product;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $userId;

    public function index()
    {
        $cartItems = CartFacade::session($this->getUserId())->getContent();
        $total = CartFacade::session($this->getUserId())->getTotal();

        return view('cart.index', ['cartItems' => $cartItems, 'total' => $total]);
    }

    public function store(Request $request)
    {
        $product = Product::find($request->product);

        CartFacade::session($this->getUserId())->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
        ]);

        return redirect()->route('cart.index');
    }

    public function destroy()
    {
        CartFacade::session($this->getUserId())->remove();
    }

    private function getUserId()
    {
        $this->userId = auth()->id();
        return $this->userId;
    }
}
