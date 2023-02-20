<?php

namespace App\View\Components;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AppLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        if (Auth::check()) {
            $cartQuantityValue = Cart::where('user_id', Auth::id())->get();
        } else {
            $cartQuantityValue = [];
        }
        $cartQuantity = count($cartQuantityValue);
        return view('layouts.app', compact('cartQuantity'));
    }
}
