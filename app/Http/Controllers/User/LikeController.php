<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Like;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LikeController extends Controller
{

    // public function index()
    // {
    //     

    //     $products = Product::whereIn('id', $likedProductIds)->get();


    //     return view('user.likes.index', compact('products'));
    // }

    public function index(Request $request)
    {
        $userId = Auth::id(); // ログインユーザーのIDを取得
        $likes = Like::where('user_id', $userId)->pluck('product_id')->toArray();
        $products = Product::displayItems()->get();

        return view('user.likes.index', compact('products', 'likes'));
    }


    public function store($productId)
    {
        Auth::user()->like($productId);
        return;
    }

    public function destroy($productId)
    {
        Auth::user()->dislike($productId);
        return;
    }
}
