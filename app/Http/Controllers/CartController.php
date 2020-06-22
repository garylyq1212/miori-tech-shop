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
        $products = CartFacade::session($this->getUserId())->getContent();
        $total = CartFacade::session($this->getUserId())->getTotal();

        return view('cart.index', ['products' => $products, 'total' => $total]);
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product);

        CartFacade::session($this->getUserId())->add([
            'id' => $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => $request->quantity,
            'associatedModel' => Product::class
        ]);

        return redirect()
            ->route('cart.index')
            ->with('status', 'Product was added to the cart!');
    }

    public function update(Request $request)
    {
        $product = Product::findOrFail($request->product);

        CartFacade::session($this->getUserId())->update([
            'quantity' => $request->quantity
        ]);

        dd($product);

        return redirect()->route('cart.index');
    }

    public function destroy(Request $request)
    {
        $product = Product::findOrFail($request->product);

        CartFacade::session($this->getUserId())->remove($product->id);

        return redirect()
            ->route('cart.index')
            ->with('status', 'Product was removed from the cart!');
    }

    private function getUserId()
    {
        $this->userId = auth()->id();
        return $this->userId;
    }
}
