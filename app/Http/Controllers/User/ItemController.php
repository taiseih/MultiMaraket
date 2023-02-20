<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ItemController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:users');
    }

    public function index(Request $request){

        $products = Product::displayItems()
        ->sortOrder($request->sort)
        ->get();
        
        return view('user.items.index', compact('products'));
    }

    public function show($id){
        $product = Product::findOrFail($id);
        $quantity = Stock::where('product_id', $product->id)->sum('quantity');
        $itemLikes = Like::where('product_id', $id)->get();

        if (auth()->check()) {
            $userLike = $itemLikes->where('user_id', auth()->user()->id)->first();
        } else {
            $userLike = null;
        }

        if($quantity > 10){
            $quantity = 10;
        }

        return view('user.items.show', compact('product', 'quantity', 'itemLikes', 'userLike'));
    }
}
