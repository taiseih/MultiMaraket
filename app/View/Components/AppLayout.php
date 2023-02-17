<?php

namespace App\View\Components;

use App\Models\Cart;
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
        $cartQuantityValue = Cart::all();
        $cartQuantity = count($cartQuantityValue);
        
        return view('layouts.app', compact('cartQuantity'));
    }
}
