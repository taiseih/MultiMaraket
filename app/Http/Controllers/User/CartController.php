<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index(){
        $user = User::findOrFail(Auth::id());
        $products = $user->product;
        $totalPrice = 0;

        foreach($products as $product){
            $totalPrice = $product->price * $product->pivot->quantity;//pivotで中間テーブルのcartsの数量を取得
        }
        return view('user.cart', compact('totalPrice', 'products'));
    }
    
    public function add(Request $request){
        $cartItem = Cart::where('product_id', $request->product_id)
        ->where('user_id', Auth::id())->first();//両方を満たすものを取得

        if(!$cartItem){
            Cart::create([
                'user_id' => Auth::id(),
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
        }else{
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        }
        return redirect()->route('user.cart.index');
    }

    public function destroy($id) {
        Cart::where('product_id', $id)
        ->where('user_id', Auth::id())
        ->delete();

        return redirect()->route('user.cart.index');
    }

    public function payment(){
        $user = User::findOrFail(Auth::id());
        $products = $user->product;

        $lineItems = [];
        foreach($products as $product){
            $lineItem = [
                'name' => $product->name,
                'description' => $product->information,
                'amount' => $product->price,
                'currency' => 'jpy',
                'quantity' => $product->pivot->quantity,
            ];
            array_push($lineItems, $lineItem);
        }
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [$lineItems],
            'mode' => 'payment',
            'success_url' => route('user.items.index'),
            'cancel_url' => route('user.cart.index'),
        ]);

        $publicKey = env('STRIPE_PUBLIC_KEY', compact('session', 'publicKey'));

        return view('user.payment', compact(''));
    }
}
